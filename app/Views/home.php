<section class="hero shadow-lg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 text-center text-lg-start animate__animated animate__fadeInLeft px-4">
                <h6 class="text-uppercase fw-bold mb-3" style="letter-spacing: 2px; color: #d1f7dd;">Total Health Solutions</h6>
                <h1 class="display-2 fw-bold mb-4">Your Health is Our <br><span style="color: #6eff9e;">Top Priority</span></h1>
                <p class="lead mb-5 opacity-90">Experience world-class healthcare with state-of-the-art technology and compassionate specialist doctors. We are open 24/7 for your emergencies.</p>

                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start">
                    <a href="<?= BASE_URL ?>auth/signup" class="btn btn-light btn-lg px-5 py-3 fw-bold shadow">Book Appointment</a>
                    <a href="#services" class="btn btn-outline-light btn-lg px-5 py-3 fw-bold">Our Services</a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row stats-bar p-4 text-center mx-2 mx-md-0">
        <div class="col-md-3 border-end">
            <h2 class="fw-bold text-success">50+</h2>
            <p class="text-muted mb-0">Specialist Doctors</p>
        </div>
        <div class="col-md-3 border-end">
            <h2 class="fw-bold text-success">25+</h2>
            <p class="text-muted mb-0">Health Departments</p>
        </div>
        <div class="col-md-3 border-end">
            <h2 class="fw-bold text-success">10k+</h2>
            <p class="text-muted mb-0">Happy Patients</p>
        </div>
        <div class="col-md-3">
            <h2 class="fw-bold text-success">24/7</h2>
            <p class="text-muted mb-0">Emergency Care</p>
        </div>
    </div>
</div>

<section class="container py-5 mt-5" id="about">
    <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="position-relative">
                <img src="https://images.unsplash.com/photo-1581056771107-24ca5f033842?w=800" alt="About" class="img-fluid rounded-4 shadow-lg">
                <div class="bg-white p-3 rounded shadow position-absolute bottom-0 end-0 m-3 d-none d-md-block">
                    <h5 class="text-success mb-0"><i class="fas fa-certificate"></i> Certified Clinic</h5>
                    <small>Awarded Best Care 2025</small>
                </div>
            </div>
        </div>
        <div class="col-md-6 ps-lg-5">
            <h6 class="text-success fw-bold text-uppercase">Who We Are</h6>
            <h2 class="display-5 fw-bold mb-4">Dedicated to Medical Excellence</h2>
            <p class="text-muted mb-4">ABC Hospitals has been a leader in medical innovation for over a decade. We provide a full spectrum of healthcare services, from routine check-ups to complex surgical procedures.</p>
            <ul class="list-unstyled mb-4">
                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Modern diagnostic laboratories</li>
                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Specialized Intensive Care Units</li>
                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Advanced robotic surgery options</li>
                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> 24/7 Pharmacy & Emergency</li>
            </ul>
            <a href="<?= BASE_URL ?>auth/login" class="btn btn-success btn-lg">Learn More About Us</a>
        </div>
    </div>
</section>

<section class="bg-light py-5" id="services">
    <div class="container py-4 text-center">
        <h6 class="text-success fw-bold text-uppercase">Our Specialties</h6>
        <h2 class="display-5 fw-bold section-title">Health Departments</h2>
        <p class="text-muted mb-5">We provide specialized care across multiple disciplines with experienced specialists.</p>

        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 p-4 feature-box shadow-sm">
                    <div class="icon-circle"><i class="fas fa-heartbeat fa-2x"></i></div>
                    <h4>Cardiology</h4>
                    <p class="small text-muted">Complete heart care including diagnostics and intervention.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 p-4 feature-box shadow-sm">
                    <div class="icon-circle"><i class="fas fa-brain fa-2x"></i></div>
                    <h4>Neurology</h4>
                    <p class="small text-muted">Specialized care for brain, spine, and nervous system disorders.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 p-4 feature-box shadow-sm">
                    <div class="icon-circle"><i class="fas fa-baby fa-2x"></i></div>
                    <h4>Pediatrics</h4>
                    <p class="small text-muted">Compassionate healthcare services for infants and children.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 p-4 feature-box shadow-sm">
                    <div class="icon-circle"><i class="fas fa-pills fa-2x"></i></div>
                    <h4>Oncology</h4>
                    <p class="small text-muted">Advanced cancer treatment and supportive therapy.</p>
                </div>
            </div>
        </div>
        <a href="<?= BASE_URL ?>auth/signup" class="btn btn-outline-success mt-4">View All Departments</a>
    </div>
</section>

<section class="container py-5" id="contact">
    <div class="row g-5">
        <div class="col-lg-5">
            <div class="contact-info-box h-100 shadow-lg">
                <h2 class="fw-bold mb-4">Get In Touch</h2>
                <p class="mb-5 opacity-75">Have questions? Reach out to our 24/7 help desk for any medical inquiry.</p>

                <div class="d-flex mb-4">
                    <div class="me-3 fs-3"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <h5 class="mb-1">Location</h5>
                        <p class="opacity-75">30 THE DOWN STREET, LONDON, WA14 2PU</p>
                    </div>
                </div>
                <div class="d-flex mb-4">
                    <div class="me-3 fs-3"><i class="fas fa-phone-alt"></i></div>
                    <div>
                        <h5 class="mb-1">Phone</h5>
                        <a href="tel: +44 21 7000 0999" style="color: #fff;" class="opacity-75">+44 21 7000 0999</a>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="me-3 fs-3"><i class="fas fa-envelope"></i></div>
                    <div>
                        <h5 class="mb-1">Email</h5>
                        <a href="mailto:support@abchospitals.com" style="color: #fff;" class="opacity-75">support@abchospitals.com</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card border-0 shadow p-4 rounded-4">
                <h3 class="fw-bold mb-4 text-success">Send us a Message</h3>
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control form-control-lg bg-light border-0" placeholder="Your Name">
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control form-control-lg bg-light border-0" placeholder="Your Email">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control form-control-lg bg-light border-0" placeholder="Subject">
                        </div>
                        <div class="col-12">
                            <textarea class="form-control form-control-lg bg-light border-0" rows="5" placeholder="Message Details"></textarea>
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-success btn-lg px-5">Submit Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>