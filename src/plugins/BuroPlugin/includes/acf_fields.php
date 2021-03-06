<?php

function buroSettings( $slug ) {
  acf_add_local_field_group(array (
    'key' => 'group_5630eba9b1062',
    'title' => 'Bürocratik Settings',
    'fields' => array (
      array (
        'key' => 'field_56334add67a7f',
        'label' => 'Master Account',
        'name' => 'master_account',
        'type' => 'user',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'role' => '',
        'allow_null' => 0,
        'multiple' => 0,
      ),
       array (
        'key' => 'field_56334add67aadsd327f',
        'label' => 'Secondary Master Account',
        'name' => 'sec_master_account',
        'type' => 'user',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'role' => '',
        'allow_null' => 0,
        'multiple' => 0,
      ),
      array (
        'key' => 'rh_field_account',
        'label' => 'RH Account',
        'name' => 'rh_account',
        'type' => 'user',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'role' => '',
        'allow_null' => 0,
        'multiple' => 0,
      ),
      array (
        'key' => 'field_5637748e22f0e',
        'label' => 'Disable Updates',
        'name' => 'disable_updates',
        'type' => 'true_false',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'message' => 'Disable all update notices. When releasing website should be true.',
        'default_value' => 1,
      ),
      array (
        'key' => 'field_56336164443d2',
        'label' => 'Environment',
        'name' => 'environment',
        'type' => 'select',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array (
          'development' => 'Development',
          'stage' => 'Stage',
          'production' => 'Production',
        ),
        'default_value' => array (
        ),
        'allow_null' => 0,
        'multiple' => 0,
        'ui' => 0,
        'ajax' => 0,
        'placeholder' => '',
        'disabled' => 0,
        'readonly' => 0,
      ),
      array (
        'key' => 'field_5630ebd688235',
        'label' => 'Hide Pages From Client',
        'name' => 'hide_pages_from_client',
        'type' => 'relationship',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array (
        ),
        'taxonomy' => array (
        ),
        'filters' => array (
          0 => 'search',
          1 => 'post_type',
          2 => 'taxonomy',
        ),
        'elements' => '',
        'max' => '',
        'return_format' => 'id',
        'min' => 0,
      ),
      array (
        'key' => 'field_56375c5243328',
        'label' => 'Hide pages from master too ?',
        'name' => 'hide_from_master',
        'type' => 'true_false',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'message' => 'Hide pages from master user, normally static templates that do not need to appear in the Backend',
        'default_value' => 0,
      ),
      array (
      'key' => 'field_563a49b74d234',
      'label' => 'Hide Pages or CPT From Client',
      'name' => 'hide_cpt_from_client',
      'type' => 'repeater',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'min' => '',
      'max' => '',
      'layout' => 'table',
      'button_label' => 'Add Row',
      'sub_fields' => array (
        array (
          'key' => 'field_563a49b74d235',
          'label' => 'Tipo de conteúdo',
          'name' => 'post_type',
          'type' => 'post_type_selector',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'select_type' => 'Checkboxes',
        ),
      ),
    ),
    array (
      'key' => 'field_563a49ea4d236',
      'label' => 'Hide CPT from master too ?',
      'name' => 'hide_cpt_from_master',
      'type' => 'true_false',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'message' => 'Hide pages from master user, normally static templates that do not need to appear in the Backend',
      'default_value' => 0,
    ),
      array (
        'key' => 'field_56334ffbdfae6',
        'label' => 'Restrict Post Type Deletion',
        'name' => 'restrict_post_type_deletion',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'min' => '',
        'max' => '',
        'layout' => 'table',
        'button_label' => 'Add Row',
        'sub_fields' => array (
          array (
            'key' => 'field_56335af644eb0',
            'label' => 'Tipo de conteúdo',
            'name' => 'post_type',
            'type' => 'post_type_selector',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'select_type' => 'Checkboxes',
          ),
        ),
      ),
      array (
        'key' => 'field_563362ad68dc1',
        'label' => 'Restrict User Deletion',
        'name' => 'restrict_user_deletion',
        'type' => 'user',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'role' => '',
        'allow_null' => 0,
        'multiple' => 1,
      ),
      array (
        'key' => 'field_56338fa6cb2f6',
        'label' => 'Restrict Add New Post',
        'name' => 'restrict_add_new_post',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'min' => '',
        'max' => '',
        'layout' => 'table',
        'button_label' => 'Add Row',
        'sub_fields' => array (
          array (
            'key' => 'field_56338fef144ea',
            'label' => 'Tipo de conteúdo',
            'name' => 'post_type',
            'type' => 'post_type_selector',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'select_type' => 'Checkboxes',
          ),
        ),
      ),
      array (
        'key' => 'field_5633a36cb176c',
        'label' => 'Login Page Color',
        'name' => 'login_page_color',
        'type' => 'color_picker',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => 33,
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
      ),
      array (
        'key' => 'field_5633a387b176d',
        'label' => 'Login Page Logo',
        'name' => 'login_page_logo',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => 33,
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'preview_size' => 'thumbnail',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
      array (
        'key' => 'field_5633b0a8b96fe',
        'label' => 'Logo Admin',
        'name' => 'logo_admin',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => 33,
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'preview_size' => 'thumbnail',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
      array (
        'key' => 'field_563735a672cac',
        'label' => 'Image Sizes',
        'name' => 'image_sizes',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'min' => '',
        'max' => '',
        'layout' => 'table',
        'button_label' => 'Add Row',
        'sub_fields' => array (
          array (
            'key' => 'field_563735ec72cad',
            'label' => 'Image Size Slug',
            'name' => 'image_slug',
            'type' => 'text',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
            'readonly' => 0,
            'disabled' => 0,
          ),
          array (
            'key' => 'field_5637360872cae',
            'label' => 'Image Width',
            'name' => 'image_width',
            'type' => 'number',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'min' => '',
            'max' => '',
            'step' => '',
            'readonly' => 0,
            'disabled' => 0,
          ),
          array (
            'key' => 'field_5637361472caf',
            'label' => 'Image Height',
            'name' => 'image_height',
            'type' => 'number',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'min' => '',
            'max' => '',
            'step' => '',
            'readonly' => 0,
            'disabled' => 0,
          ),
          array (
            'key' => 'field_5637361d72cb0',
            'label' => 'Hard Crop',
            'name' => 'hard_crop',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'message' => '',
            'default_value' => 1,
          ),
        ),
      ),
      array (
        'key' => 'field_56374085d6a62',
        'label' => 'Plugins Needed',
        'name' => 'plugins_needed',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'min' => '',
        'max' => '',
        'layout' => 'table',
        'button_label' => 'Add Row',
        'sub_fields' => array (
          array (
            'key' => 'field_56374099d6a63',
            'label' => 'Nome',
            'name' => 'plugin_name',
            'type' => 'text',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
            'readonly' => 0,
            'disabled' => 0,
          ),
          array (
            'key' => 'field_563740a3d6a64',
            'label' => 'URL',
            'name' => 'plugin_slug',
            'type' => 'text',
            'instructions' => 'The slug used by the plugin ( must match the plugin actual slug )',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
            'readonly' => 0,
            'disabled' => 0,
          ),
          array (
            'key' => 'field_563740c5d6a65',
            'label' => 'Required',
            'name' => 'plugin_required',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'message' => '',
            'default_value' => 0,
          ),
        ),
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'options_page',
          'operator' => '==',
          'value' => $slug,
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
  ));
}
function globalConfig( $posts_in ) {
  acf_add_local_field_group(array (
    'key' => 'group_5633b6bd2767f',
    'title' => '_Global Config',
    'fields' => array (
      // array (
      //   'key' => 'field_5633b6ff4582f',
      //   'label' => 'Current Menu',
      //   'name' => 'config_current_menu',
      //   'type' => 'text',
      //   'instructions' => '',
      //   'required' => 0,
      //   'conditional_logic' => 0,
      //   'wrapper' => array (
      //     'width' => '',
      //     'class' => 'buro-admin',
      //     'id' => '',
      //   ),
      //   'default_value' => '',
      //   'placeholder' => '',
      //   'prepend' => '',
      //   'append' => '',
      //   'maxlength' => '',
      //   'readonly' => 0,
      //   'disabled' => 0,
      // ),
      array (
        'key' => 'field_5633b72445830',
        'label' => 'Ajax Controller',
        'name' => 'config_current_page',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => 'buro-admin',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
        'readonly' => 0,
        'disabled' => 0,
      ),
      array (
        'key' => 'field_5633b72445831',
        'label' => 'Current Controller',
        'name' => 'config_current_controller',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => 'buro-admin',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
        'readonly' => 0,
        'disabled' => 0,
      ),
      array (
        'key' => 'field_56372c345eb46',
        'label' => 'Configurações - Redes Sociais',
        'name' => '',
        'type' => 'message',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => 'buro-separator',
          'id' => '',
        ),
        'message' => '',
        'new_lines' => 'wpautop',
        'esc_html' => 0,
      ),
      array (
        'key' => 'field_56372c575eb47',
        'label' => 'Título',
        'name' => 'social_title',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
        'readonly' => 0,
        'disabled' => 0,
      ),
      array (
        'key' => 'field_56372c7c5eb48',
        'label' => 'Descrição para as redes sociais',
        'name' => 'social_description',
        'type' => 'textarea',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => '',
        'new_lines' => '',
        'readonly' => 0,
        'disabled' => 0,
      ),
      array (
        'key' => 'field_56372c8f5eb49',
        'label' => 'Imagem para as redes sociais',
        'name' => 'social_image',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'preview_size' => 'thumbnail',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
    ),
    'location' => $posts_in,
    'menu_order' => 0,
    'position' => 'side',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
  ));
}

?>