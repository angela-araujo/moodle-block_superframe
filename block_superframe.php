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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

/**
 * block_superframe main file
 *
 * @package block_superframe
 * @copyright Daniel Neis <danielneis@gmail.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Modified for use in MoodleBites for Developers Level 1
 * by Richard Jones & Justin Hunt.
 *
 * See: https://www.moodlebites.com/mod/page/view.php?id=24546
 */
defined ( 'MOODLE_INTERNAL' ) || die ();

/*
 *
 * Notice some rules that will keep plugin approvers happy when you want
 * to register your plugin in the plugins database
 *
 * Use 4 spaces to indent, no tabs
 * Use 8 spaces for continuation lines
 * Make sure every class has php doc to describe it
 * Describe the parameters of each class and function
 *
 * https://docs.moodle.org/dev/Coding_style
 */

/**
 * Class superframe minimal required block class.
 */
class block_superframe extends block_base {

    /**
     * Initialize our block with a language string.
     */
    function init() {
        $this->title = get_string ( 'pluginname', 'block_superframe' );
    }

    /**
     * Add some text content to our block.
     */
    function get_content() {
        global $USER, $CFG;

        // Do we have any content?
        if ($this->content !== null) {
            return $this->content;
        }

        if (empty ( $this->instance )) {
            $this->content = '';
            return $this->content;
        }

        // OK let's add some content.
        $this->content = new stdClass ();
        $this->content->footer = '';
        $this->content->text = get_string ( 'welcomeuser', 'block_superframe', $USER );
        // $this->content->text .= '<br><i>'.get_string('message', 'block_superframe').'</i>';

        // Check user permission to see the view page.
        // $usercontext = context_instance::$USER->id;
        $usercontext = context_user::instance ( $USER->id );

        if (has_capability ( 'block/superframe:seeviewpage', $usercontext )) {

            // Add the block id to the Moodle URL for the view page.
            $blockid = $this->instance->id;
            $url = new moodle_url ( '/blocks/superframe/view.php', [ 
                    'blockid' => $blockid
            ] );
            $this->content->text .= '<p>' . html_writer::link ( $url, get_string ( 'viewlink', 'block_superframe' ) ) . '</p>';
        }

        return $this->content;
    }

    /**
     * This is a list of places where the block may or
     * may not be added.
     */
    public function applicable_formats() {
        return array (
                'all' => false,
                'site' => true,
                'site-index' => true,
                'course-view' => true,
                'my' => true
        );
    }

    /**
     * Allow multiple instances of the block.
     */
    function instance_allow_multiple() {
        return true;
    }

    /**
     * Allow block configuration.
     */
    function has_config() {
        return true;
    }
}
