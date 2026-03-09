@extends("layouts.front_app")

@section("content")

    <canvas id="bannerCanvas"></canvas>

    <div class="projects_page page-section">
        
        <div class="projects-hero">
            
            <div class="hero-content">
                <h1 class="hero-title">Our Portfolio</h1>
                <p class="hero-subtitle">Crafting digital experiences that captivate and convert</p>
            </div>
            <div class="hero-scroll-indicator">
                <span>Scroll to explore</span>
                <div class="scroll-arrow"></div>
            </div>
        </div>

        <div class="projects-container">
            <div class="container">
                <div class="projects-grid">
                    <!-- Project 1 -->
                    <div class="project-card" data-category="branding" data-delay="0">
                        <div class="project-image">
                            <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=1200&q=80" alt="Luxury Fashion Brand">
                            <div class="project-overlay">
                                <div class="overlay-content">
                                    <span class="project-category">Branding</span>
                                    <h3 class="project-title">Luxury Fashion Brand</h3>
                                    <p class="project-description">Elevating a premium fashion label with sophisticated visual identity and digital presence.</p>
                                    <a href="#" class="project-link">View Project <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="project-info">
                            <span class="project-category">Branding</span>
                            <h3 class="project-title">Luxury Fashion Brand</h3>
                            <p class="project-excerpt">Sophisticated visual identity for premium fashion label</p>
                        </div>
                    </div>

                    <!-- Project 2 -->
                    <div class="project-card" data-category="digital" data-delay="100">
                        <div class="project-image">
                            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=1200&q=80" alt="E-commerce Platform">
                            <div class="project-overlay">
                                <div class="overlay-content">
                                    <span class="project-category">Digital</span>
                                    <h3 class="project-title">E-commerce Platform</h3>
                                    <p class="project-description">Seamless shopping experience with intuitive navigation and stunning product displays.</p>
                                    <a href="#" class="project-link">View Project <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="project-info">
                            <span class="project-category">Digital</span>
                            <h3 class="project-title">E-commerce Platform</h3>
                            <p class="project-excerpt">Seamless shopping experience with intuitive navigation</p>
                        </div>
                    </div>

                    <!-- Project 3 -->
                    <div class="project-card" data-category="campaign" data-delay="200">
                        <div class="project-image">
                            <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=1200&q=80" alt="Social Media Campaign">
                            <div class="project-overlay">
                                <div class="overlay-content">
                                    <span class="project-category">Campaign</span>
                                    <h3 class="project-title">Social Media Campaign</h3>
                                    <p class="project-description">Viral content strategy that generated millions of impressions and engagement.</p>
                                    <a href="#" class="project-link">View Project <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="project-info">
                            <span class="project-category">Campaign</span>
                            <h3 class="project-title">Social Media Campaign</h3>
                            <p class="project-excerpt">Viral content strategy with millions of impressions</p>
                        </div>
                    </div>

                    <!-- Project 4 -->
                    <div class="project-card" data-category="branding" data-delay="300">
                        <div class="project-image">
                            <img src="https://images.unsplash.com/photo-1558403194-611b2f6fb84e?auto=format&fit=crop&w=1200&q=80" alt="Tech Startup Identity">
                            <div class="project-overlay">
                                <div class="overlay-content">
                                    <span class="project-category">Branding</span>
                                    <h3 class="project-title">Tech Startup Identity</h3>
                                    <p class="project-description">Modern and innovative brand identity for cutting-edge technology company.</p>
                                    <a href="#" class="project-link">View Project <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="project-info">
                            <span class="project-category">Branding</span>
                            <h3 class="project-title">Tech Startup Identity</h3>
                            <p class="project-excerpt">Modern brand identity for cutting-edge technology company</p>
                        </div>
                    </div>

                    <!-- Project 5 -->
                    <div class="project-card" data-category="digital" data-delay="400">
                        <div class="project-image">
                            <img src="https://images.unsplash.com/photo-1559028012-481c04fa702d?auto=format&fit=crop&w=1200&q=80" alt="Mobile App Design">
                            <div class="project-overlay">
                                <div class="overlay-content">
                                    <span class="project-category">Digital</span>
                                    <h3 class="project-title">Mobile App Design</h3>
                                    <p class="project-description">Intuitive mobile application with sleek interface and smooth user experience.</p>
                                    <a href="#" class="project-link">View Project <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="project-info">
                            <span class="project-category">Digital</span>
                            <h3 class="project-title">Mobile App Design</h3>
                            <p class="project-excerpt">Intuitive mobile app with sleek interface and smooth UX</p>
                        </div>
                    </div>

                    <!-- Project 6 -->
                    <div class="project-card" data-category="campaign" data-delay="500">
                        <div class="project-image">
                            <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=1200&q=80" alt="Brand Launch">
                            <div class="project-overlay">
                                <div class="overlay-content">
                                    <span class="project-category">Campaign</span>
                                    <h3 class="project-title">Brand Launch</h3>
                                    <p class="project-description">Comprehensive launch strategy that positioned the brand as an industry leader.</p>
                                    <a href="#" class="project-link">View Project <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="project-info">
                            <span class="project-category">Campaign</span>
                            <h3 class="project-title">Brand Launch</h3>
                            <p class="project-excerpt">Comprehensive launch strategy positioning brand as leader</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="projects-cta">
            <div class="container">
                <div class="cta-content">
                    <h2 class="cta-title">Ready to start your project?</h2>
                    <p class="cta-subtitle">Let's create something extraordinary together</p>
                    <a href="{{route('contact')}}" class="cta-button">Get In Touch</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Include projects CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/projects.css') }}">
    
    <!-- Include projects JavaScript -->
    <script src="{{ asset('js/projects.js') }}"></script>
@endsection
