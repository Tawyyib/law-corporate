<?php

/* Collection of Walker Classes *
    
     @see Walker::start_lvl()
     *
     * @param string   $output Used to append additional content (passed by reference), html markup.
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     * 
     * 
     * @see Walker::start_el()
     *
     * @param string   $output Used to append additional content information of all generated html markup (passed by reference).
     * @param string   $item   Information of all different item contained in our single element, including the attributes i.e. <a>. Used for padding.
     * @param int      $depth  Depth of 
     * @param stdClass $args   An object of wp_nav_menu() arguments. contain information of our items, what's before or after etc.
     * @param int      $id   
     *   
*/

// the walker Class

if ( !class_exists('walkerNavMenuPrimary') ) {

    class walkerNavMenuPrimary extends Walker_Nav_menu {

        public $isMegaMenu;

        public $count;

        public function __construct(){

            $this->isMegaMenu = 0;

            $this->count = 0;
        }

        // Handles the <ul> generation, starts with creating the first submenu <ul>
        public function start_lvl( &$output, $depth = 0, $args = array() ){ 

            // Creates the Indentation for organising the code
            $indent = str_repeat("\t", $depth);
            
            //if level == 0, sub-menu is not appended
            $submenu = ($depth > 0) ? ' sub-menu' : '';
            $output .= "\n$indent<ul class=\"dropdown-menu$submenu depth-$depth\">\n";

            // introduce the MegaMenu
            if ($this->isMegaMenu != 0){
                $output .= "<li class\"col-sm-3\"><ul>\n";
            }

        }

        // Handles the opening <li><a><span> and other opened tags, with premade variables to pre-populates and use to define prefine attributes the walker class generates for us
        public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0){

            // Creates the Indentation for organising the code  
            $indent = ($depth) ? str_repeat("\t", $depth) : '';

            // Variables to populate our custom HTML markups
            $li_attributes = '';    //
            $class_names = $value = ''; //

            // retrieving data/information from our actual items
            // checks if the array item included is empty. If not empty, returns the array with the item classes included.
            $classes[] = empty( $item->classes ) ? array() : (array) $item->classes; 
            $classes = array();

            $classes[] = 'nav-item';   

            // Adding specific classes to the variable above, without overriding it
            // if the sub-menu li-item has children append the dropend class
			//if ($depth > 0 && $args->walker->has_children) {
			//	$classes[] = 'dropend';
			//} else {
			//	$classes[] = 'dropdown';
			//}
			
            $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
            $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
            $classes[] = 'menu-item-'.$item->ID;
                    
            if($depth && $args->walker->has_children)
            {
                $classes[] = 'dropdown-submenu';
            }		

            $class_names = join( ' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args) );
            $class_names = 'class="'. esc_attr($class_names) .'"';

            $id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
            $id = strlen($id) ? 'id="'. esc_attr($id) . '"' : '';

            // print our elements <li> and attributes
            $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . ' >';

            // build the attributes of the <a> tags and content
            $attributes  = array();
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr($item->attr_title) . '" ' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr($item->target    ) . '" ' : '';
            if ( '_blank' === $item->target && empty( $item->xfn ) ) {
                $attributes .= ' rel="' . esc_attr(noopener, noreferrer) .'" ';
            } else {
                $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'" ' : '';
            }
            //    $attributes .= !( '_blank' === $item->target && empty( $item->xfn ) ) ? ' rel="' . esc_attr($item->xfn) . '" ' : 'noopener';
            $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '" ' : '';
            $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '" ' : '';
            $attributes .= ! empty( $item->url && $depth==0 && $args->walker->has_children ) ? ' href="" ' : ' href="' . esc_attr($item->url) . '" ';
            $attributes .= ! empty( $item->url && $depth>=0 || $args->walker->has_children ) ? ' href="" ' : ' href="' . esc_attr($item->url) . '" ';
            $attributes .= ! empty( $item->current || $item->current_item_anchestor ) ? ' aria-current="' . 'page' . '" ' : '';
            $attributes .= ( $args->walker->has_children ) ? ' data-bs-toggle="dropdown" ' : '';

            //  Adding Classes to the links
            $classes = array();
            $classes[] = 'nav-link';   
            if ($depth == 1)
			{
				$classes[] = 'dropdown-item nav-dropdown-link';   
			}
			if($depth > 1)
			{
				$classes[] = 'dropdown-item nav-sub-dropdown-link';   
			}

            // Adding specific classes to the variable above, without overriding it
            $classes[] .= ($args->walker->has_children) ? 'dropdown-toggle' : '';
            $classes[] .= ($item->current || $item->current_item_ancestor) ? 'active' : '';

            $class_names = join( ' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args) );
            $class_names = 'class="'. esc_attr($class_names) .'"';
            
            //Print the <a> tag 
            $item_output = $args->before;
            $item_output .= '<a' . $attributes . $class_names . '>'; // the 'a' link
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;    //the link title
            $item_output .= ( $depth >= 0 && $args->walker->has_children) ? ' <span class="caret"></span></a>' : '</a>';
            $item_output .= $args->after;

            $output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

        }

        
        // ... existing code ...

        //  function end_el(&$output, $item, $depth = 0, $args = array(), $id = 0){
        //    $output .= "</li>"; // Close the <li> tag
        //  }

        //  function end_lvl(&$output, $depth = 0, $args = array()){
        //    $indent = str_repeat("\t", $depth);
        //    $output .= "$indent</ul>\n"; // Close the <ul> tag for submenus
        //  }

          // ... existing code ...

        public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
        {
            if (!$element) {
                return;
            }

            $id_field = $this->db_fields['id'];

            //display this element
            if (is_array($args[0])) {
                $args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
            } elseif (is_object($args[0])) {
                $args[0]->walker->has_children = !empty($children_elements[$element->$id_field]);
            }

            $cb_args = array_merge(array(&$output, $element, $depth), $args);
            call_user_func_array(array($this, 'start_el'), $cb_args);

            $id = $element->$id_field;

            // descend only when the depth is right and there are childrens for this element
            if (($max_depth == 0 || $max_depth > $depth + 1) && isset($children_elements[$id])) {
                foreach ($children_elements[ $id ] as $child) {
                    if (!isset($newlevel)) {
                        $newlevel = true;
                  //start the child delimiter
                  $cb_args = array_merge(array(&$output, $depth), $args);
                        call_user_func_array(array($this, 'start_lvl'), $cb_args);
                    }
                    $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
                }
                unset($children_elements[ $id ]);
            }

            if (isset($newlevel) && $newlevel) {
                //end the child delimiter
              $cb_args = array_merge(array(&$output, $depth), $args);
                call_user_func_array(array($this, 'end_lvl'), $cb_args);
            }

            //end this element
            $cb_args = array_merge(array(&$output, $element, $depth), $args);
            call_user_func_array(array($this, 'end_el'), $cb_args);
        }

    }
}