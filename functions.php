<?php

function random_featured_exhibit()
{
    $html = '';
    $featuredExhibit = exhibit_builder_random_featured_exhibit();
    if ($featuredExhibit) {
        $html .= get_view()->partial('exhibit-builder/exhibits/single.php', array('exhibit' => $featuredExhibit));
    } else {
        $html .= '<p class="card-body">' . __('No featured exhibits are available.') . '</p>';
    }
    $html = apply_filters('exhibit_builder_display_random_featured_exhibit', $html);
    return $html;
}

function my_random_featured_items($count = 5, $hasImage = null)
{
    $items = get_random_featured_items($count, $hasImage);
    if ($items) {
        $html = '';
        foreach ($items as $item) {
            $html .= get_view()->partial('items/single.php', array('item' => $item));
            release_object($item);
        }
    } else {
        $html = '<p class="card-body">' . __('No featured items are available.') . '</p>';
    }
    return $html;
}

function my_random_featured_collection()
{
    $collection = get_random_featured_collection();
    if ($collection) {
        $html = get_view()->partial('collections/single.php', array('collection' => $collection));
        release_object($collection);
    } else {
        $html = '<p class="card-body">' . __('No featured collections are available.') . '</p>';
    }
    return $html;
}

function public_nav_main_bootstrap() {
    $partial = array('common/menu-main-partial.phtml', 'default');
    $nav = public_nav_main();  // this looks like $this->navigation()->menu() from Zend
    $nav->setPartial($partial);
    return $nav->render();
}

function public_nav_sidebar_bootstrap() {
    $partial = array('common/menu-sidebar-partial.phtml', 'default');
    $nav = public_nav_main();  // this looks like $this->navigation()->menu() from Zend
    $nav->setPartial($partial);
    return $nav->render();
}

function public_nav_pills_bootstrap() {
    $partial = array('common/menu-item-pills-partial.phtml', 'default');
    $nav = public_nav_items();  // this looks like $this->navigation()->menu() from Zend
    $nav->setPartial($partial);
    return $nav->render();
}

function public_nav_pills_bootstrap_exhibit() {
    $partial = array('common/menu-item-pills-partial.phtml', 'default');
    $nav = public_nav_items(array(
        array(
            'label' => __('Browse All'),
            'uri' => url('exhibits')
        ),
        array(
            'label' => __('Browse by Tag'),
            'uri' => url('exhibits/tags')
        )
    ));  // this looks like $this->navigation()->menu() from Zend
    $nav->setPartial($partial);
    return $nav->render();
}

function recent_items_bootstrap($recentItems,$type){
	if($type=='list'){
		return recent_items($recentItems);
		}
	elseif($type=='grid'){
	$items = get_recent_items($recentItems);
    if ($items) {
        $html = '';
        foreach ($items as $item) {
            $html .= get_view()->partial('items/grid.php', array('item' => $item));
            release_object($item);
        }
    } else {
        $html = '<p>' . __('No recent items available.') . '</p>';
    }
    return $html;
		}
        elseif($type=='sidebar'){
    $items = get_recent_items($recentItems);
    if ($items) {
        $html = '';
        foreach ($items as $item) {
            $html .= get_view()->partial('items/sidebar.php', array('item' => $item));
            release_object($item);
        }
    } else {
        $html = '<p>' . __('No recent items available.') . '</p>';
    }
    return $html;
        }
}

function bs_link_logo_to_navbar($text = null, $props = array())
{
    if (!$text) {
        $text = option('site_title');
    }

    if(theme_logo()){$logo= "";}
    else $logo="onlytext";

    return '<a  class="navbar-brand '.$logo.'" href="' . html_escape(WEB_ROOT) . '" '. tag_attributes($props) . '>'.theme_logo(). $text . "</a>\n";
}

function bs_header_bg()
{
    $headerImage = get_theme_option('Header Background Image');
    if ($headerImage) {
        $storage = Zend_Registry::get('storage');
        $headerImage = $storage->getUri($storage->getPathByType($headerImage, 'theme_uploads'));
        return $headerImage;
    }
}

function bs_header_logo($height)
{
    $headerImage = get_theme_option('Header Logo Image');
    if ($headerImage) {
        $storage = Zend_Registry::get('storage');
        $headerImage = $storage->getUri($storage->getPathByType($headerImage, 'theme_uploads'));
        return '<img alt="header-logo" class="img-responsive center-block" style="height:'.$height.'vh;" src="' . $headerImage . '" />';
    }
}
