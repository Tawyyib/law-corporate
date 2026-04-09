<?php

    /** 
     * PROJECTS DSIPLAY OBJECTS 
     * Displays project details in a structured sidebar format
     */

        
    /**     PROJECT POST CARD      */
    if(! function_exists('lc_projects_card')){

        function lc_projects_card(){

            $location_city = get_post_meta(get_the_ID(), 'location_city', true);
            $location_state = get_post_meta(get_the_ID(), 'location_state', true);
            $location_country = get_post_meta(get_the_ID(), 'location_country', true);

            
            $location_parts = array(
                $location_city,
                $location_state,
                $location_country,
            );
            $project_location = implode(', ', array_filter($location_parts, function($value) {
                return !empty($value);
            }));

            // Duration
            $start_date = get_post_meta(get_the_ID(), 'start_date', true);
            $end_date = get_post_meta(get_the_ID(), 'end_date', true);
                
            // Initialize variables for date display        
            $project_status = '';

            if ($start_date || $end_date) {

                // Convert the date string to a DateTime object
                $start_date_obj = DateTime::createFromFormat('Y-m-d', $start_date);
                $end_date_obj = DateTime::createFromFormat('Y-m-d', $end_date);

                if ($start_date_obj) {

                    // Format the date to show only the year
                    $project_start_date = $start_date_obj->format('Y');

                } else {

                    $project_start_date = null;

                }

                if ($end_date_obj) {

                    // Format the date to show only the year
                    $project_end_date = $end_date_obj->format('Y');

                } else {

                    $project_end_date = null;

                }

                $today = new DateTime();
                    
                    /*
                    if ($start_date_obj && $end_date_obj) {

                            // Calculate difference
                            $interval = $start_date_obj->diff($end_date_obj);

                            $years  = $interval->y;
                            $months = $interval->m;

                            // Build duration string
                            if ($years > 0 && $months > 0) {

                                $project_duration = "{$years} Yr" . ($years > 1 ? 's' : '') . " {$months} Mth" . ($months > 1 ? 's' : '');

                            } elseif ($years > 0) {

                                $project_duration = "{$years} Yr" . ($years > 1 ? 's' : '');

                            } elseif ($months > 0) {

                                $project_duration = "{$months} Mth" . ($months > 1 ? 's' : '');

                            } else {

                                $project_duration = "Less than a month";

                            }

                    }                    
                    */

                // Determine Project Status
                if ( $project_end_date > $today) {

                    $project_status = 'In Progress';

                } else {

                    $project_status = "Completed";

                }

            } else {

                $project_status = "Unknown";

            }

            ?>

                <article class="project-card" > 
                                    
                    <?php if ( has_post_thumbnail() ) : ?>

                    <a href="<?php esc_url(get_the_permalink()); ?>" class="project-card__thumbnail mb-0" title="<?php the_title_attribute(); ?>">

                        <?php the_post_thumbnail('post-thumbnail', array('class' => 'project-card__thumbnail-image', 'alt' => get_the_title(), 'title' => get_the_title() )); ?>
                                
                    </a>

                    <?php endif; ?>
                                                        
                    <div class="project-card__body justify-content-center" >

                        <h4 class="project-card__body-title" ><a href="<?php echo the_permalink() ?>"  class="<?php echo esc_attr(''); ?>" ><?php the_title(); ?></a></h4>
                               
                        <div class="project-card__body-text my-2" >

                            <p><?php echo substr(get_the_excerpt(),0, 203, ) ?></p>
                                            
                        </div>
                                                                                    
                        <div class="project-card__meta">
                            <b><?php echo esc_html('Location:');  ?>&nbsp;</b><span class="project-card__meta-item" ><?php echo esc_html($project_location);  ?></span>
                        </div>                                                                                    
                        <div class="project-card__meta">
                            <b><?php echo esc_html('Status:');  ?>&nbsp;</b><span class="project-card__meta-item" ><?php echo esc_html($project_status);  ?></span>
                        </div>
                        
                    </div>   
                                                                                                                      
                </article>

            <?php

        }
        add_action('', 'lc_projects_card');

    }

    /**     PROJECT SIDEBAR METADATA     */
    function project_aside_data_enhanced() {

        // Main
        if (!function_exists('lc_project_metadata')) {

            function lc_project_metadata() {

                global $post;
                    
                if (!$post) return;
                
                // Get project metadata with proper sanitization
                $project_meta = get_project_metadata_array($post->ID);
                
                echo '<aside class="' . esc_attr('project__metadata col-smd-12') . '">';
                echo '<div class="project__metadata_inner">';
                
                // Display each metadata item
                display_metadata_item(__('Competence Jurisdiction', 'law-corporate'), $project_meta['competency']);
                //display_metadata_item(__('Services Provided', 'law-corporate'), $project_meta['services'], '—', 'services');
                display_metadata_item(__('Project Owner', 'law-corporate'), $project_meta['owner'], '—');
                display_metadata_item(__('Sponsor', 'law-corporate'), $project_meta['sponsor'], '—');
                display_metadata_item(__('Financier', 'law-corporate'), $project_meta['financier'], __('Client/Sponsor Funded.', 'law-corporate'));
                display_metadata_item(__('Partnering Consultant(s)', 'law-corporate'), $project_meta['partners'], __('Sole Consultant.', 'law-corporate'));
                display_metadata_item(__('Contract Value', 'law-corporate'), $project_meta['project_value']);
                display_metadata_item(__('Location', 'law-corporate'), $project_meta['location']);
                display_metadata_item(__('Coverage', 'law-corporate'), $project_meta['project_coverage']);
                display_metadata_item(__('Duration', 'law-corporate'), $project_meta['duration']);
                display_metadata_item(__('Status', 'law-corporate'), $project_meta['status']);
                
                echo '</div>';
                echo '</aside>';
            }
            
        }

        /**
         * Helper function 1: to get all project metadata in a structured array
         */
        function get_project_metadata_array($post_id) {

            $cache_key = "project_meta_{$post_id}";
            $cached_meta = wp_cache_get($cache_key, 'projects');
            
            if ($cached_meta !== false) {
                return $cached_meta;
            }

            // Get competency terms
            $competency_terms = wp_get_post_terms($post_id, 'competency', array("fields" => "names"));
            $competency = !is_wp_error($competency_terms) ? $competency_terms : array();
            
            // Get project services
            //$project_services = get_project_services_display($post_id);
            
            // Get project ownership data
            $project_owner = get_post_meta_safe($post_id, 'project_owner');
            $project_sponsor = get_post_meta_safe($post_id, 'project_sponsor');
            $project_financier = get_post_meta_safe($post_id, 'project_financier');
            $project_partners = get_post_meta_safe($post_id, 'project_partners');
            
            // Build Project value String    
            $project_value = get_post_meta($post_id, 'project_value', true);        
                    
            // Get location data
            $location_city = get_post_meta($post_id, 'location_city', true);
            $location_state = get_post_meta($post_id, 'location_state', true);
            $location_country = get_post_meta($post_id, 'location_country', true);
            
            // Build location string
            $location_parts = array_filter([$location_city, $location_state, $location_country]);
            $project_location = implode(', ', $location_parts);      
            
            // Build Project Coverage String    
            $project_coverage = get_post_meta($post_id, 'project_coverage', true);        
            
            // Get date data
            $start_date = get_post_meta($post_id, 'start_date', true);
            $end_date = get_post_meta($post_id, 'end_date', true);

            // Process dates and calculate duration
            $date_data = calculate_project_duration($start_date, $end_date);
            
            // Format duration - handle empty duration gracefully
            $duration_display = format_duration_display($date_data['year_range'], $date_data['duration']);
            
            return [
                'competency' => implode(', ', $competency),
            //  'services' => $project_services,
                'owner' => $project_owner,
                'sponsor' => $project_sponsor,
                'financier' => $project_financier,
                'partners' => $project_partners,
                'project_value' => $project_value,
                'location' => $project_location,
                'project_coverage' => $project_coverage,
                'duration' => $duration_display,
                'status' => $date_data['status']
            ];
                
            wp_cache_set($cache_key, $project_meta, 'projects', HOUR_IN_SECONDS);
            return $project_meta;
        
        }

        /**
         * Helper function 2: Get project services for display
         */
        function get_project_services_display($post_id) {

            $service_ids = get_post_meta($post_id, 'project_services', true);
            
            // Return empty array if no services selected
            if (empty($service_ids) || !is_array($service_ids)) {
                return array();
            }
            
            $services = array();
            
            foreach ($service_ids as $service_id) {
                $service = get_post($service_id);
                if ($service && $service->post_status === 'publish') {
                    $services[] = $service->post_title;
                }
            }
            
            return $services;

        }
        
        /**
         * Helper function 5: Display individual metadata item with consistent formatting - handles both regular and service formatting
        */
        function display_metadata_item($title, $value, $fallback = '—', $display_type = 'default') {
            $display_value = '';
            
            // Handle empty values
            if (empty($value)) {
                $display_value = $fallback ? esc_html($fallback) : '—';
            } 
            // Handle services with special tag formatting
            elseif ($display_type === 'services' && is_array($value)) {
                $display_value = '<div class="services-list">';
                foreach ($value as $service) {
                    $display_value .= '<span class="service-tag">' . esc_html($service) . '</span>';
                }
                $display_value .= '</div>';
            }
            // Handle arrays with comma separation
            elseif (is_array($value)) {
                $display_value = implode(', ', array_map('esc_html', $value));
            }
            // Handle simple values
            else {
                $display_value = esc_html($value);
            }
            
            // Output the formatted item
            echo '<div class="project__metadata_item">';
            echo '<span class="project__metadata_item-title">' . esc_html($title) . '</span>';
            echo '<span class="project__metadata_item-value' . ($display_type === 'services' ? ' services-list' : '') . '">' . $display_value . '</span>';
            echo '</div>';
        }

        /**
         * Format duration display with proper empty state handling
         */
        function format_duration_display($year_range, $duration) {

            // If both year range and duration are empty
            if (empty($year_range) && empty($duration)) {
                return '';
            }
            
            // If we have year range but no duration
            if (!empty($year_range) && empty($duration)) {
                return $year_range;
            }
            
            // If we have duration but no year range (unlikely but handle it)
            if (empty($year_range) && !empty($duration)) {
                return $duration;
            }
            
            // Both year range and duration are available
            return $year_range . ' (' . $duration . ')';

        }

        function build_location_string($city, $state, $country) {
            $parts = array_filter([
                sanitize_text_field($city),
                sanitize_text_field($state),
                sanitize_text_field($country)
            ]);
            
            if (empty($parts)) {
                return '';
            }
            
            return implode(', ', $parts);
        }

        /**
         * Safe getter for array post meta with fallback
         */
        function get_post_meta_safe($post_id, $key) {

            $value = get_post_meta($post_id, $key, true);
            return is_array($value) && !empty($value) ? $value : array();

        }

        /**
         * Calculate project duration, year range, and status
         */
        function calculate_project_duration($start_date, $end_date) {

            $defaults = [
                'duration' => '',
                'year_range' => '',
                'status' => __('Not Determined Yet', 'law-corporate')
            ];
            
            // Validate date formats
            $start_date_obj = validate_and_create_date($start_date);
            $end_date_obj = validate_and_create_date($end_date);
            
            if (!$start_date_obj) {
                return $defaults;
            }
            
            if ($end_date_obj) {

                return handle_completed_project($start_date_obj, $end_date_obj);

            } else {

                return handle_ongoing_project($start_date_obj);

            }

        }

        function validate_and_create_date($date_string) {
            if (empty($date_string)) {
                return false;
            }
            
            // Try multiple date formats
            $formats = ['Y-m-d', 'd/m/Y', 'm/d/Y'];
            foreach ($formats as $format) {
                $date = DateTime::createFromFormat($format, $date_string);
                if ($date !== false) {
                    return $date;
                }
            }
            
            return false;
        }

        /**
         * Handle completed or in-progress projects with both dates
         */
        function handle_completed_project($start_date_obj, $end_date_obj) {

            $interval = $start_date_obj->diff($end_date_obj);
            $today = new DateTime();
            
            $duration = format_duration($interval->y, $interval->m);
            $start_year = $start_date_obj->format('Y');
            $end_year = $end_date_obj->format('Y');
            
            if ($end_date_obj > $today) {

                // Project is in progress
                return [
                    'duration' => $duration,
                    'year_range' => $start_year . ' – ' . __('Present', 'law-corporate'),
                    'status' => __('In Progress', 'law-corporate')
                ];

            } else {

                // Project is completed
                return [
                    'duration' => $duration,
                    'year_range' => $start_year . ' – ' . $end_year,
                    'status' => __('Completed', 'law-corporate')
                ];

            }

        }

        /**
         * Handle ongoing projects with only start date
         */
        function handle_ongoing_project($start_date_obj) {

            $now = new DateTime();
            $interval = $start_date_obj->diff($now);
            
            $duration = format_duration($interval->y, $interval->m);
            
            return [
                'duration' => $duration,
                'year_range' => $start_date_obj->format('Y') . ' – ' . __('Present', 'law-corporate'),
                'status' => __('In Progress', 'law-corporate')
            ];

        }

        /**
         * Format duration string from years and months
         */
        function format_duration($years, $months) {

            if ($years > 0 && $months > 0) {
                return sprintf(
                    _n('%d Yr', '%d Yrs', $years, 'law-corporate') . ' ' . 
                    _n('%d Mth', '%d Mths', $months, 'law-corporate'),
                    $years, $months
                );
            } elseif ($years > 0) {
                return sprintf(_n('%d Yr', '%d Yrs', $years, 'law-corporate'), $years);
            } elseif ($months > 0) {
                return sprintf(_n('%d Mth', '%d Mths', $months, 'law-corporate'), $months);
            } else {
                return __('Less than a month', 'law-corporate');
            }

        }

        /**
         * Updated main function using enhanced display
         */
        if (!function_exists('lc_project_metadata_enhanced')) {

            function lc_project_metadata_enhanced() {

                global $post;
                
                // Get project metadata with proper sanitization
                $project_meta = get_project_metadata_array($post->ID);
                
                echo '<aside class="' . esc_attr('project__metadata col-smd-12') . '">';
                echo '<div class="project__metadata_inner">';
                
                // Display each metadata item
                display_metadata_item_enhanced(__('Related Competence', 'law-corporate'), $project_meta['competency']);
                display_metadata_item_enhanced(__('Services Provided', 'law-corporate'), $project_meta['services'], '—', 'services');
                display_metadata_item_enhanced(__('Project Owner', 'law-corporate'), $project_meta['owner'], '—');
                display_metadata_item_enhanced(__('Sponsor', 'law-corporate'), $project_meta['sponsor'], '—');
                display_metadata_item_enhanced(__('Financier', 'law-corporate'), $project_meta['financier'], __('Client/Sponsor Funded.', 'law-corporate'));
                display_metadata_item_enhanced(__('Partnering Consultant(s)', 'law-corporate'), $project_meta['partners'], __('Sole Consultant.', 'law-corporate'));
                display_metadata_item_enhanced(__('Location', 'law-corporate'), $project_meta['location']);
                display_metadata_item_enhanced(__('Duration', 'law-corporate'), $project_meta['duration']);
                display_metadata_item_enhanced(__('Status', 'law-corporate'), $project_meta['status']);
                
                echo '</div>';
                echo '</aside>';
            }

        }

        
    }
    project_aside_data_enhanced();

    
    // B. Project Page Permalink
    if(!function_exists('get_projects_permalink')){

        function get_projects_permalink(){ 
            
            // Get the permalink for the 'about' page
            $project_permalink = get_permalink_by_slug('projects');

            if ($project_permalink) {

                echo esc_url($project_permalink);

            } else {

                echo esc_html__('link not found.', "law-corporate");

            }

        }
        add_action('', 'get_projects_permalink');

    }