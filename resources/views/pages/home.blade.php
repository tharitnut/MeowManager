@extends('frontend')

@section('css_before')
<link href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@400;600;700&display=swap" rel="stylesheet">
<style>
  html, body { background:#fff8da; color:#5c4630; }
  body { font-family:'Kodchasan', sans-serif; }

  .btn-pill { border-radius:999px; padding:.75rem 1.25rem; font-weight:700; }
  .card-soft { border:0; border-radius:18px; box-shadow:0 8px 24px rgba(0,0,0,.08); background:#ffffff; }
  .section-pad { padding:72px 0; }

  .text-coffee { color:#6b4226!important; }

  .bg-cream { background:#fff8da!important; }
  .bg-butter { background:#fbea82!important; }
  .bg-beige { background:#e6ccb2!important; }
  .bg-newsletter { background:#ecd9c6!important; } /* ✅ NEW background for newsletter */
  .bg-coffee { background:#6b4226!important; }

  .ring { box-shadow:0 0 0 6px rgba(255,248,218,.7); }

  /* Hero */
  .hero {
    position:relative;
    overflow:hidden;
    background:#fff8da;
    padding:96px 0 40px;
  }

  .hero h1 {
    font-size:clamp(2.25rem,3vw,3.5rem);
    color:#6b4226;
    font-weight:800;
    line-height:1.1;
  }

  .hero-sub {
    color:#5c4630;
    font-size:1.1rem;
  }

  .hero-blob {
    position:absolute;
    right:-12vw;
    top:-10vw;
    width:48vw;
    height:48vw;
    background:radial-gradient(ellipse at 30% 30%, #7fcdd7 0%, #9fe1e8 55%, transparent 56%);
    border-radius:50%;
    filter:blur(2px);
    opacity:.25;
    pointer-events:none;
  }

  .hero-circle {
    width:min(520px,90%);
    aspect-ratio:1/1;
    background:#a7c957;
    border-radius:50%;
    margin:0 auto;
    display:grid;
    place-items:center;
    position:relative;
  }

  .hero-circle img {
    width:82%;
    height:auto;
    filter:drop-shadow(0 12px 24px rgba(0,0,0,.18));
  }

  .rating-badge {
    position:absolute;
    bottom:-14px;
    left:-14px;
    background:#7fcdd7;
    color:#fff8da;
    padding:10px 16px;
    border-radius:12px;
    font-weight:700;
    font-size:.95rem;
    box-shadow:0 8px 24px rgba(0,0,0,.08);
  }

  /* Chips */
  .chip {
    display:inline-flex;
    align-items:center;
    gap:.5rem;
    background:#fbea82;
    color:#6b4226;
    border-radius:999px;
    padding:6px 14px;
    font-weight:600;
    font-size:.95rem;
  }

  /* Icons */
  .icon-bubble {
    width:56px;
    height:56px;
    border-radius:50%;
    display:grid;
    place-items:center;
    background:#fff8da;
    color:#6b4226;
    border:2px solid rgba(107,66,38,.15);
  }

  /* Modules */
  .module {
    transition:transform .18s ease, box-shadow .18s ease;
  }

  .module:hover {
    transform:translateY(-4px);
    box-shadow:0 10px 28px rgba(0,0,0,.1);
  }

  /* Stats */
  .stat {
    font-size:2.25rem;
    font-weight:800;
    color:#6b4226;
  }

  .stat small {
    font-size:.95rem;
    font-weight:600;
    color:#5c4630;
  }

  /* Stripes & CTA */
  .stripe {
    background: linear-gradient(180deg, #e6ccb2, #f5dcc7);
    border-radius: 28px;
    padding-left: 24px;
    padding-right: 24px;
    margin-left: 16px;
    margin-right: 16px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0,0,0,.06);
  }

  /* Footer */
  .footer {
    background:#6b4226;
    color:#fff8da;
    border-radius:28px;
    padding:48px 28px;
    font-size:.95rem;
  }

  .footer a {
    color:#fff8da;
    text-decoration:none;
  }

  .footer a:hover {
    color:#f4978e;
  }
</style>
@endsection

@section('navbar')
@endsection

@section('showProduct')
<!-- HERO: Cafe-facing -->
<section class="hero">
  <div class="hero-blob"></div>
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="chip mb-3">🐾 Welcome to MeowMoment Café</span>
        <h1>Cozy sips, gentle purrs, and happy moments.</h1>
        <p class="hero-sub mt-3">
          A warm cat café in the heart of Bangkok. Reserve a session, enjoy signature drinks,
          and spend quality time with our friendly feline residents.
        </p>
        <div class="mt-4 d-flex flex-wrap gap-2">
          <a href="/cat_page" class="btn btn-pill" style="background:#fbea82; color:#6b4226; border:0; width: 10rem">View Cat →</a>
          <a href="/menu_page" class="btn btn-pill" style="background:#7fcdd7; color:#fff8da; border:0; width: 10rem">View Menu →</a>
        </div>
        <div class="d-flex align-items-center gap-3 mt-4">
          <img src="https://img.icons8.com/ios-glyphs/48/cat-footprint.png" width="28" height="28" alt="paw" loading="lazy">
          <small class="text-coffee"><strong>4.9★</strong> from visitors · <strong>Clean & calm</strong> environment</small>
        </div>
      </div>
      <div class="col-lg-6 text-center">
        <div class="hero-circle ring">
          <img src="https://images.unsplash.com/photo-1543852786-1cf6624b9987?q=80&w=1200&auto=format&fit=crop" alt="Cat hero" class="rounded-3" loading="lazy">
          <div class="rating-badge">Purr time awaits ★★★★★</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- HOW IT WORKS: Visitor flow -->
<section class="section-pad">
  <div class="container">
    <div class="text-center mb-4">
      <h2 class="text-coffee fw-bold">How it works</h2>
      <p class="mb-0">Enjoy a relaxing visit with coffee, treats, and our roaming cats.</p>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card-soft h-100 p-4">
          <div class="icon-bubble mb-3">
            <img src="https://img.icons8.com/ios-glyphs/48/enter-2.png" width="28" height="28" alt="Walk in">
          </div>
          <h4 class="text-coffee">1) Walk in</h4>
          <p>Come by anytime during our open hours. Our friendly staff will guide you to a cozy table.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card-soft h-100 p-4">
          <div class="icon-bubble mb-3">
            <img src="https://img.icons8.com/ios-glyphs/48/coffee.png" width="28" height="28" alt="Order">
          </div>
          <h4 class="text-coffee">2) Order & enjoy</h4>
          <p>Pick your favorite drinks and desserts from our cat-themed menu and relax at your table.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card-soft h-100 p-4">
          <div class="icon-bubble mb-3">
            <img src="https://img.icons8.com/ios-glyphs/48/cat.png" width="28" height="28" alt="Play with cats">
          </div>
          <h4 class="text-coffee">3) Play with cats</h4>
          <p>Our cats roam freely around the café. Watch them nap, play, or come over for cuddles while you sip.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- HOUSE RULES -->
<section class="section-pad stripe">
  <div class="container">
    <h2 class="text-coffee fw-bold mb-3">House rules (for happy cats & guests)</h2>
    <div class="row g-3">
      <div class="col-md-6">
        <div class="card-soft p-3">
          <ul class="mb-0">
            <li>Sanitize hands before entering the cat room.</li>
            <li>No flash photography and keep voices soft.</li>
            <li>Let cats approach you first; avoid picking them up.</li>
          </ul>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card-soft p-3">
          <ul class="mb-0">
            <li>No outside food for cats; treats available in-store.</li>
            <li>Children must be supervised at all times.</li>
            <li>Follow staff guidance for everyone's safety.</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="mt-3"><small>Questions? Message us on Instagram or call the café—happy to help!</small></div>
  </div>
</section>

<!-- NEWSLETTER -->
<section class="section-pad">
  <div class="container">
    <div class="card-soft p-4 p-md-5 bg-newsletter">
      <div class="row align-items-center g-3">
        <div class="col-md">
          <h4 class="text-coffee mb-1">Get promos & cat news</h4>
          <div>Exclusive offers and adorable updates—no spam.</div>
        </div>
        <div class="col-md-5">
          <form class="d-flex gap-2">
            <input type="email" class="form-control" placeholder="Your email" required>
            <button class="btn btn-pill" type="submit" style="background:#f4978e; color:#6b4226; border:0">Subscribe</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<footer class="footer mt-4">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4">
        <h5 class="mb-2">MeowMoment Café</h5>
        <p class="mb-3">A cozy cat café for calm moments, soft paws, and good coffee.</p>
        <div class="d-flex gap-3">
          <a href="#"><img src="https://img.icons8.com/ios-filled/50/ffffff/facebook-new.png" width="22" alt="fb"></a>
          <a href="#"><img src="https://img.icons8.com/ios-filled/50/ffffff/instagram-new.png" width="22" alt="ig"></a>
          <a href="#"><img src="https://img.icons8.com/ios-filled/50/ffffff/twitter.png" width="22" alt="x"></a>
        </div>
      </div>
      <div class="col-md-4">
        <h6 class="mb-2">Visit</h6>
        <div>800/114 Sukhumvit Road, Watthana, Bangkok 10110</div>
        <div class="mt-2">Mon-Fri 8:00-20:00 · Sat-Sun 9:00-18:00</div>
      </div>
      <div class="col-md-4">
        <h6 class="mb-2">Contact</h6>
        <div>Email: <a href="mailto:hello@MeowMoment.cafe">hello@meowmoment.cafe</a></div>
        <div>Phone: <a href="tel:+17047740540">+1 (704) 774-0540</a></div>
      </div>
    </div>
    <hr class="my-4" style="border-top:1px solid #a7c957">
    <p class="text-center mb-0">© 2025 MeowMoment Café. All rights reserved.</p>
  </div>
</footer>
@endsection

@section('footer')
@endsection

@section('js_before')
@endsection
