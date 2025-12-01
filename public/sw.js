"use strict";

const VERSION = "v2";
const STATIC_CACHE = `static-cache-${VERSION}`;
const RUNTIME_CACHE = `runtime-cache-${VERSION}`;
const OFFLINE_URL = "/offline.html";

const PRECACHE_URLS = [
    "/",
    "/admin/login",
    "/offline.html",
    "/manifest.json",
    "/logo.png",
    "/logo.jpg",
    "/landingPage/css/style.css",
    "/landingPage/img/dashboard2.PNG"
];

const ASSET_PATH_PREFIXES = [
    "/landingPage/",
    "/assets/",
    "/vendor/filament/",
    "/css/",
    "/js/"
];

const STATIC_EXTENSIONS = [
    ".css",
    ".js",
    ".png",
    ".jpg",
    ".jpeg",
    ".svg",
    ".woff",
    ".woff2",
    ".ttf",
    ".eot",
    ".ico",
    ".json"
];

self.addEventListener("install", (event) => {
    self.skipWaiting();
    event.waitUntil(
        caches.open(STATIC_CACHE).then((cache) => cache.addAll(PRECACHE_URLS))
    );
});

self.addEventListener("activate", (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) =>
            Promise.all(
                cacheNames.map((name) => {
                    if (![STATIC_CACHE, RUNTIME_CACHE].includes(name)) {
                        return caches.delete(name);
                    }

                    return null;
                })
            )
        ).then(() => self.clients.claim())
    );
});

self.addEventListener("fetch", (event) => {
    const { request } = event;

    if (request.method !== "GET") {
        return;
    }

    const url = new URL(request.url);

    if (request.mode === "navigate") {
        event.respondWith(networkFirst(request));
        return;
    }

    if (shouldHandleAsStaticAsset(url)) {
        event.respondWith(cacheFirst(request));
        return;
    }

    if (url.pathname.startsWith("/admin")) {
        event.respondWith(networkFirst(request));
        return;
    }
});

function shouldHandleAsStaticAsset(url) {
    if (ASSET_PATH_PREFIXES.some((prefix) => url.pathname.startsWith(prefix))) {
        return true;
    }

    return STATIC_EXTENSIONS.some((ext) => url.pathname.endsWith(ext));
}

async function cacheFirst(request) {
    const cache = await caches.open(STATIC_CACHE);
    const cachedResponse = await cache.match(request);
    if (cachedResponse) {
        return cachedResponse;
    }

    try {
        const networkResponse = await fetch(request);
        cache.put(request, networkResponse.clone());
        return networkResponse;
    } catch (error) {
        return caches.match(OFFLINE_URL);
    }
}

async function networkFirst(request) {
    const cache = await caches.open(RUNTIME_CACHE);
    try {
        const networkResponse = await fetch(request);
        cache.put(request, networkResponse.clone());
        return networkResponse;
    } catch (error) {
        const cachedResponse = await cache.match(request);
        if (cachedResponse) {
            return cachedResponse;
        }

        if (request.mode === "navigate") {
            return caches.match(OFFLINE_URL);
        }

        throw error;
    }
}
