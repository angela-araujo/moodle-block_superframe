<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Renderer for the super frame block.
 *
 * @package   block_superframe
 * @copyright 2019 Angela de Araujo - by MoodleBites Course
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_superframe_renderer extends plugin_renderer_base {
    
    function display_view_page($url, $width, $heigth) {
        
        global $USER;
        
        $data = new stdClass();
        
        // Page heading and iframe data.
        $data->heading = get_string('pluginname', 'block_superframe');
        $data->url = $url;
        $data->height = $heigth;
        $data->width = $width;        
        $data->userpix = $this->output->user_picture($USER, array('size' => 35));        
        $data->username = fullname($USER);
        
        // Start output to browser.
        echo $this->output->header();
        
        // Render the data in a Mustache template.
        echo $this->render_from_template('block_superframe/frame', $data);
        
        // Finish the page.
        echo $this->output->footer();
    }
}