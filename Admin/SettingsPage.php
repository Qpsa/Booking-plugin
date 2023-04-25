<?php

namespace Admin;

class SettingsPage
{
    public function registerSettingFields()
    {
        /**
         * First, we add_settings_section. This is necessary since all future settings must belong to one.
         * Second, add_settings_field
         * Third, register_setting
         */
        add_settings_section(
        // ID used to identify this section and with which to register options
            SettingsProvider::OPTIONS_GENERAL_SECTION,
            // Title to be displayed on the administration page
            '',
            // Callback used to render the description of the section
            [$this,'mypluginDisplayGeneralAccount'],
            // Page on which to add this section of options
            'myplugin_general_settings'
        );

        add_settings_field(
            SettingsProvider::OPTION_NAME_DEFAULT_SMS_PROVIDER,
            'Send messages from this number:',
            [$this, 'mypluginRenderSettingsField'],
            'myplugin_general_settings',
            SettingsProvider::OPTIONS_GENERAL_SECTION,
            [
                'type'      => 'input',
                'subtype'   => 'text',
                'id'    => SettingsProvider::OPTION_NAME_DEFAULT_SMS_PROVIDER,
                'name'      => SettingsProvider::OPTION_NAME_DEFAULT_SMS_PROVIDER,
                'required' => 'true',
                'get_options_list' => '',
                'value_type'=>'normal',
                'wp_data' => 'option'
            ]
        );

        register_setting(
            'myplugin_general_settings',
            SettingsProvider::OPTION_NAME_DEFAULT_SMS_PROVIDER
        );

        add_settings_field(
            SettingsProvider::OPTION_NAME_TWILIO_ID,
            'Twillio ID:',
            [$this, 'mypluginRenderSettingsField'],
            'myplugin_general_settings',
            SettingsProvider::OPTIONS_GENERAL_SECTION,
            [
                'type'      => 'input',
                'subtype'   => 'text',
                'id'    => SettingsProvider::OPTION_NAME_TWILIO_ID,
                'name'      => SettingsProvider::OPTION_NAME_TWILIO_ID,
                'required' => 'true',
                'get_options_list' => '',
                'value_type'=>'normal',
                'wp_data' => 'option'
            ]
        );

        register_setting(
            'myplugin_general_settings',
            SettingsProvider::OPTION_NAME_TWILIO_ID
        );

        add_settings_field(
            SettingsProvider::OPTION_NAME_TWILIO_TOKEN,
            'Twillio TOKEN:',
            [$this, 'mypluginRenderSettingsField'],
            'myplugin_general_settings',
            SettingsProvider::OPTIONS_GENERAL_SECTION,
            [
                'type'      => 'input',
                'subtype'   => 'password',
                'id'    => SettingsProvider::OPTION_NAME_TWILIO_TOKEN,
                'name'      => SettingsProvider::OPTION_NAME_TWILIO_TOKEN,
                'required' => 'true',
                'get_options_list' => '',
                'value_type'=>'normal',
                'wp_data' => 'option'
            ]
        );

        register_setting(
            'myplugin_general_settings',
            SettingsProvider::OPTION_NAME_TWILIO_TOKEN
        );

        add_settings_field(
            SettingsProvider::OPTION_NAME_PAYSERA_PROJECT_ID,
            'Paysera project ID:',
            [$this, 'mypluginRenderSettingsField'],
            'myplugin_general_settings',
            SettingsProvider::OPTIONS_GENERAL_SECTION,
            [
                'type'      => 'input',
                'subtype'   => 'text',
                'id'    => SettingsProvider::OPTION_NAME_PAYSERA_PROJECT_ID,
                'name'      => SettingsProvider::OPTION_NAME_PAYSERA_PROJECT_ID,
                'required' => 'true',
                'get_options_list' => '',
                'value_type'=>'normal',
                'wp_data' => 'option'
            ]
        );

        register_setting(
            'myplugin_general_settings',
            SettingsProvider::OPTION_NAME_PAYSERA_PROJECT_ID
        );

        add_settings_field(
            SettingsProvider::OPTION_NAME_PAYSERA_PROJECT_PASSWORD,
            'Paysera project password:',
            [$this, 'mypluginRenderSettingsField'],
            'myplugin_general_settings',
            SettingsProvider::OPTIONS_GENERAL_SECTION,
            [
                'type'      => 'input',
                'subtype'   => 'password',
                'id'    => SettingsProvider::OPTION_NAME_PAYSERA_PROJECT_PASSWORD,
                'name'      => SettingsProvider::OPTION_NAME_PAYSERA_PROJECT_PASSWORD,
                'required' => 'true',
                'get_options_list' => '',
                'value_type'=>'normal',
                'wp_data' => 'option'
            ]
        );

        register_setting(
            'myplugin_general_settings',
            SettingsProvider::OPTION_NAME_EMAIL_SMTP_PORT,
        );

        add_settings_field(
            SettingsProvider::OPTION_NAME_EMAIL_SMTP_PORT,
            'SMTP Email port:',
            [$this, 'mypluginRenderSettingsField'],
            'myplugin_general_settings',
            SettingsProvider::OPTIONS_GENERAL_SECTION,
            [
                'type'      => 'input',
                'subtype'   => 'text',
                'id'    => SettingsProvider::OPTION_NAME_EMAIL_SMTP_PORT,
                'name'      => SettingsProvider::OPTION_NAME_EMAIL_SMTP_PORT,
                'required' => 'true',
                'get_options_list' => '',
                'value_type'=>'normal',
                'wp_data' => 'option'
            ]
        );

        register_setting(
            'myplugin_general_settings',
            SettingsProvider::OPTION_NAME_EMAIL_SMTP_HOST,
        );

        add_settings_field(
            SettingsProvider::OPTION_NAME_EMAIL_SMTP_HOST,
            'SMTP Email host:',
            [$this, 'mypluginRenderSettingsField'],
            'myplugin_general_settings',
            SettingsProvider::OPTIONS_GENERAL_SECTION,
            [
                'type'      => 'input',
                'subtype'   => 'text',
                'id'    => SettingsProvider::OPTION_NAME_EMAIL_SMTP_HOST,
                'name'      => SettingsProvider::OPTION_NAME_EMAIL_SMTP_HOST,
                'required' => 'true',
                'get_options_list' => '',
                'value_type'=>'normal',
                'wp_data' => 'option'
            ]
        );

        register_setting(
            'myplugin_general_settings',
            SettingsProvider::OPTION_NAME_EMAIL_SMTP_HOST
        );

        add_settings_field(
            SettingsProvider::OPTION_NAME_EMAIL_SMTP_USERNAME,
            'SMTP Email username:',
            [$this, 'mypluginRenderSettingsField'],
            'myplugin_general_settings',
            SettingsProvider::OPTIONS_GENERAL_SECTION,
            [
                'type'      => 'input',
                'subtype'   => 'text',
                'id'    => SettingsProvider::OPTION_NAME_EMAIL_SMTP_USERNAME,
                'name'      => SettingsProvider::OPTION_NAME_EMAIL_SMTP_USERNAME,
                'required' => 'true',
                'get_options_list' => '',
                'value_type'=>'normal',
                'wp_data' => 'option'
            ]
        );

        register_setting(
            'myplugin_general_settings',
            SettingsProvider::OPTION_NAME_EMAIL_SMTP_USERNAME
        );

        add_settings_field(
            SettingsProvider::OPTION_NAME_EMAIL_SMTP_PASSWORD,
            'SMTP Email password:',
            [$this, 'mypluginRenderSettingsField'],
            'myplugin_general_settings',
            SettingsProvider::OPTIONS_GENERAL_SECTION,
            [
                'type'      => 'input',
                'subtype'   => 'password',
                'id'    => SettingsProvider::OPTION_NAME_EMAIL_SMTP_PASSWORD,
                'name'      => SettingsProvider::OPTION_NAME_EMAIL_SMTP_PASSWORD,
                'required' => 'true',
                'get_options_list' => '',
                'value_type'=>'normal',
                'wp_data' => 'option'
            ]
        );

        register_setting(
            'myplugin_general_settings',
            SettingsProvider::OPTION_NAME_EMAIL_SMTP_PASSWORD
        );

        add_settings_field(
            SettingsProvider::OPTION_NAME_EMAIL_SENDGRID_API,
            'Email SendGrid Api key:',
            [$this, 'mypluginRenderSettingsField'],
            'myplugin_general_settings',
            SettingsProvider::OPTIONS_GENERAL_SECTION,
            [
                'type'      => 'input',
                'subtype'   => 'password',
                'id'    => SettingsProvider::OPTION_NAME_EMAIL_SENDGRID_API,
                'name'      => SettingsProvider::OPTION_NAME_EMAIL_SENDGRID_API,
                'required' => 'true',
                'get_options_list' => '',
                'value_type'=>'normal',
                'wp_data' => 'option'
            ]
        );

        register_setting(
            'myplugin_general_settings',
            SettingsProvider::OPTION_NAME_EMAIL_SENDGRID_API
        );

    }

    public function mypluginDisplayGeneralAccount() {
        ?>
            <p>
                <?php _e('These settings apply to all Plugin Name functionality.', PLUGIN_TRANSLATION_SLUG) ?>
            </p>
            <?php
    }

    public function mypluginRenderSettingsField($args) {
        /* EXAMPLE INPUT
                  'type'      => 'input',
                  'subtype'   => '',
                  'id'    => $this->plugin_name.'_example_setting',
                  'name'      => $this->plugin_name.'_example_setting',
                  'required' => 'required="required"',
                  'get_option_list' => "",
                    'value_type' = serialized OR normal,
        'wp_data'=>(option or post_meta),
        'post_id' =>
        */
        if($args['wp_data'] === 'option'){
            $wp_data_value = get_option($args['name']);
        } elseif($args['wp_data'] === 'post_meta'){
            $wp_data_value = get_post_meta($args['post_id'], $args['name'], true );
        }

        switch ($args['type']) {

            case 'input': //
                $value = ($args['value_type'] == 'serialized') ? serialize($wp_data_value) : $wp_data_value;
                if($args['subtype'] != 'checkbox'){
                    $prependStart = (isset($args['prepend_value'])) ? '<div class="input-prepend"> <span class="add-on">'.$args['prepend_value'].'</span>' : '';
                    $prependEnd = (isset($args['prepend_value'])) ? '</div>' : '';
                    $step = (isset($args['step'])) ? 'step="'.$args['step'].'"' : '';
                    $min = (isset($args['min'])) ? 'min="'.$args['min'].'"' : '';
                    $max = (isset($args['max'])) ? 'max="'.$args['max'].'"' : '';
                    if(isset($args['disabled'])){
                        // hide the actual input bc if it was just a disabled input the information saved in the database would be wrong - bc it would pass empty values and wipe the actual information
                        echo $prependStart.'<input type="'.$args['subtype'].'" id="'.$args['id'].'_disabled" '.$step.' '.$max.' '.$min.' name="'.$args['name'].'_disabled" size="40" disabled value="' . esc_attr($value) . '" /><input type="hidden" id="'.$args['id'].'" '.$step.' '.$max.' '.$min.' name="'.$args['name'].'" size="40" value="' . esc_attr($value) . '" />'.$prependEnd;
                    } else {
                        echo $prependStart.'<input type="'.$args['subtype'].'" id="'.$args['id'].'" "'.$args['required'].'" '.$step.' '.$max.' '.$min.' name="'.$args['name'].'" size="40" value="' . esc_attr($value) . '" />'.$prependEnd;
                    }
                    /*<input required="required" '.$disabled.' type="number" step="any" id="'.$this->plugin_name.'_cost2" name="'.$this->plugin_name.'_cost2" value="' . esc_attr( $cost ) . '" size="25" /><input type="hidden" id="'.$this->plugin_name.'_cost" step="any" name="'.$this->plugin_name.'_cost" value="' . esc_attr( $cost ) . '" />*/

                } else {
                    $checked = ($value) ? 'checked' : '';
                    echo '<input type="'.$args['subtype'].'" id="'.$args['id'].'" "'.$args['required'].'" name="'.$args['name'].'" size="40" value="1" '.$checked.' />';
                }
                break;
            default:
                # code...
                break;
        }
    }

    public function displaySettings()
    {
        ?>
        <div class="wrap">
            <div id="icon-themes" class="icon32"></div>
            <h2>Plugin Name Settings</h2>
            <?php
            settings_errors();
            ?>
            <form method="POST" action="options.php">
                <?php
                settings_fields('myplugin_general_settings');
                do_settings_sections('myplugin_general_settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}