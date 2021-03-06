<?php

require_once dirname(__FILE__) . '/functions.php';

/**
 * The UG PDF Index plugin.
 */
class BloggerPlugin extends Omeka_Plugin_AbstractPlugin
{
    
    protected $_hooks = array(
        'public_head',
        'admin_head',
    );

    public function hookPublicHead($args) {
        queue_css_file('blogger');
    }

    public function hookAdminHead($args) {
        queue_css_file('blogger');
    }

    public function setUp() {
        add_shortcode('blog', array('BloggerPlugin', 'renderBlog'));
        parent::setUp();
    }

    public function renderBlog($args, $view) {

        if (!isset($args['url'])) {
            return;
        }
        libxml_use_internal_errors(true);

        $xml = file_get_contents($args['url']);

        if(simplexml_load_string($xml)){
        libxml_get_errors();
        libxml_clear_errors();
        $feed = array();
        try {
            $feed = new Zend_Feed_Rss($args['url']);
        }
        catch(Exception $e) {
        
        }

        $display = "long";
        if(isset($args['display'])) {
            $display = $args['display'] == "short" ? "short" : "long";
        }

        $limit = 0;
        if(isset($args['limit'])) {
            $limit = (int)$args['limit'];
        }

        $links = FALSE;
        if(isset($args['links'])) {
            $links = (bool)$args['links'];
        }

        $more = FALSE;
        if(isset($args['more'])) {
            $more = (bool)$args['more'];
        }

        $html = $view->partial('blog.php', array('posts' => $feed, 'display' => $display, 'limit' => $limit, 'links' => $links, 'more' => $more));
        return $html;} 
        else {
        echo "<h2> An RSS news feed below is not loading correctly. E-mail us at XXXX. </h2>";
        }
    }
   
}
