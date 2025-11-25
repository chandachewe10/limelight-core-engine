<!DOCTYPE html>
<html lang="en">
<head>
    @PwaHead 
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ config('app.name') }}</title>
    <style>
      :root {
        --lime: #32cd32;
        --gold: #ffd700;
      }

      * {
        box-sizing: border-box;
      }

      body {
        margin: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        font-family: "Segoe UI", system-ui, -apple-system, sans-serif;
        background: linear-gradient(165deg, var(--lime) 0%, var(--gold) 100%);
        color: #ffffff;
      }

      header {
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #ffffff;
      }

      header .brand {
        font-size: 1.2rem;
        letter-spacing: 0.08em;
        font-weight: 700;
        text-transform: uppercase;
      }

      header .tagline {
        font-size: 0.95rem;
        color: #ffffff;
      }

      main {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2rem;
      }

      .hero {
        width: 100%;
        max-width: 960px;
        background: rgba(0, 0, 0, 0.15);
        border: 2px solid rgba(255, 255, 255, 0.35);
        border-radius: 32px;
        padding: 3rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
      }

      .hero__content {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
      }

      .hero__title {
        margin: 0;
        font-size: clamp(2.2rem, 4vw, 3.4rem);
        line-height: 1.1;
        color: #ffffff;
        text-transform: uppercase;
      }

      .hero__description {
        color: #ffffff;
        font-size: 1rem;
        line-height: 1.6;
        max-width: 36ch;
      }

      .cta {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        background: var(--gold);
        color: var(--lime);
        border: 2px solid var(--lime);
        border-radius: 999px;
        padding: 0.95rem 2.75rem;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        transition: transform 180ms ease, box-shadow 180ms ease;
      }

      .cta:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(50, 205, 50, 0.3);
      }

      .hero__panel {
        background: rgba(255, 255, 255, 0.12);
        color: #ffffff;
        border-radius: 24px;
        padding: 2rem;
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
      }

      .panel__label {
        font-size: 0.95rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #ffffff;
      }

      .panel__value {
        font-size: clamp(1.8rem, 3vw, 2.6rem);
        font-weight: 700;
        color: #ffffff;
      }

      .panel__stat {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.95rem;
        color: #ffffff;
      }

      .panel__badge {
        padding: 0.4rem 1.2rem;
        border-radius: 999px;
        background: var(--lime);
        color: var(--gold);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
      }

      footer {
        padding: 1.5rem 2rem;
        text-align: center;
        font-size: 0.9rem;
        color: #ffffff;
      }

      @media (max-width: 768px) {
        header,
        footer {
          text-align: center;
          flex-direction: column;
          gap: 0.5rem;
        }

        .hero {
          padding: 2rem;
        }
      }
    </style>

    <!-- Open Graph (Facebook & LinkedIn) -->
    <meta property="og:title" content="{{ config('app.name') }}" />
    <meta property="og:description" content="Lendfy is a loan management software that helps lenders automate workflows, reduce manual work, and launch new products with ease." />
    <meta property="og:image" content="{{ asset('logo.PNG') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:locale" content="en_US" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="LendFy Loan Management" />
    <meta name="twitter:title" content="{{ config('app.name') }}" />
    <meta name="twitter:description" content="Lendfy is a loan management software that helps lenders automate workflows, reduce manual work, and launch new products with ease." />
    <meta name="twitter:image" content="{{ asset('logo.PNG') }}" />
    <meta name="twitter:url" content="{{ url()->current() }}" />
    <meta name="twitter:site" content="" />

    <!-- LinkedIn Enhancements -->
    <meta name="linkedin:owner" content="" />
    <meta name="linkedin:card" content="LendFy Loan Management" />
</head>

  <body>
    <header>
      <div class="brand">{{ config('app.name') }}</div>
      <div class="tagline">Loan Management System</div>
    </header>

    <main>
      <section class="hero">
        <div class="hero__content">
          <p class="panel__label">Introducing</p>
          <h1 class="hero__title">LIMELIGHT MONEYLINK SERVICES LIMITED</h1>
          <p class="hero__description">
            End-to-end loan origination, monitoring, and repayment flows wrapped
            in a lightning-fast admin console.
          </p>
          <a href="{{ url('admin/login') }}" class="cta">Launch Admin</a>
        </div>
        <div class="hero__panel">
          <div>
            <p class="panel__label">Operational Uptime</p>
            <p class="panel__value">99.99%</p>
          </div>
          <div class="panel__stat">
            <span>Branches running Limelight suite</span>
            <span class="panel__badge">1</span>
          </div>
          
        </div>
      </section>
    </main>

    <footer>
      &copy; {{ date('Y') }} Limelight Moneylink Services Limited. All rights
      reserved.
    </footer>

    @RegisterServiceWorkerScript
  </body>
</html>
