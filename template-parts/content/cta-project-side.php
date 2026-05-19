                    <style>
                .sidebar-card {
                    padding: 1.5rem;
                    background: #f8f9fa;
                    border-radius: 1rem;
                    margin-bottom: 1.5rem;
                    
                    h4 {
                        font-size: 1rem;
                        font-weight: 700;
                        margin-bottom: 1rem;
                        padding-bottom: 0.5rem;
                        border-bottom: 2px solid #C21E2E;
                        display: inline-block;
                    }                        
                        
                    &.cta-card {
                            text-align: center;
                            background: linear-gradient(135deg, #0a1928 0%, #0d2a3f 100%);
                            color: white;
                            
                            i {
                                font-size: 2rem;
                                color: #C21E2E;
                                margin-bottom: 1rem;
                            }
                            
                            h4 {
                                color: white;
                                border-bottom-color: #C21E2E;
                            }
                            
                            p {
                                font-size: 0.875rem;
                                color: rgba(255, 255, 255, 0.8);
                                margin-bottom: 1rem;
                            }
                            
                            .cta-button {
                                display: inline-block;
                                padding: 0.5rem 1rem;
                                background: #C21E2E;
                                color: white;
                                text-decoration: none;
                                border-radius: 2rem;
                                font-size: 0.75rem;
                                font-weight: 600;
                                transition: all 0.3s ease;
                                
                                &:hover {
                                    background: #a01826;
                                    transform: translateY(-2px);
                                }
                            }
                    }
                    
                }                       
                    </style>
                    <div class="sidebar-card cta-card">
                        <i class="fas fa-envelope"></i>
                        <h4>Interested in Similar Projects?</h4>
                        <p>Let's discuss how we can support your 
                            <?php if ( $post_type ) {
                                get_the_title( $post_type );
                            } ?> initiatives</p>
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="cta-button">
                            Contact Our Team
                        </a>
                    </div>