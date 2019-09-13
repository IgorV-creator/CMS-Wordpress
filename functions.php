<?php
	//Подключаем стили и определяем приоритет
add_action( 'wp_enqueue_scripts', 'my_child_theme_scripts' );
	function my_child_theme_scripts() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css');
		wp_enqueue_style( 'style', get_stylesheet_uri() );
}


	//Функция вывода iframe таксометра
function form(){
		echo '<div class="gallery-content">
		 <span  class="text_menu-map">TAXI<span style="color: #ff0000;">&amp;</span>ДОСТАВКА</span></br>
	 	 <iframe width="100%" height="600" frameborder="1" src="https://taximeter.yandex.rostaxi.org/request/form/****************"></iframe>
		</div>';
}

	// регистрирует тип записей Заказы (record type The property)
add_action( 'init', 'register_post_types' );
	function register_post_types(){
		register_post_type('property', array(
			'label'  => null,
			'labels' => array(
				'name'               => 'Такси ЯЕду', // основное название для типа записи
				'singular_name'      => 'Заказ', // название для одной записи этого типа
				'add_new'            => 'Добавить заказ', // для добавления новой записи
				'add_new_item'       => 'Добавление заказа', // заголовка у вновь создаваемой записи в админ-панели.
				'edit_item'          => 'Редактирование заказа', // для редактирования типа записи
				'new_item'           => 'Новый заказ', // текст новой записи
				'view_item'          => 'Смотреть заказы', // для просмотра записи этого типа.
				'search_items'       => 'Искать заказ', // для поиска по этим типам записи
				'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
				'not_found_in_trash' => 'Не найдено в выбранных', // если не было найдено в корзине
				'parent_item_colon'  => 'Заказы', // для родителей (у древовидных типов)
				'menu_name'          => 'Все заказы парка "ЯЕду"', // название меню
			),
			'description'         => 'Заказы таксопарка "ЯЕду"',
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 3,
			'menu_icon'           => null,
			'show_in_nav_menus'   => true,
			'supports'            => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'),
			'taxonomies'          => array('deal','view'),
			'has_archive'         => true,
			'rewrite'             => true,
			'can_export'		  => true,
			'delete_with_user'	  => true,
		) 
	);
}
	// Создаем таксономию "Тип объявления" для постов типа "property"
add_action('init', 'deal_property_taxonomy');
    function deal_property_taxonomy(){
	// Добавляем древовидную таксономию 'deal' (категории)
		register_taxonomy('deal', array('property'), array(
			'hierarchical'  => true,
			'labels'        => array(
				'name'              => _x('Категория заказов', 'taxonomy general name'),
				'singular_name'     => _x('Категория заказа', 'taxonomy singular name'),
				'search_items'      =>  __('Поиск типа заказа'),
				'all_items'         => __('Все заказы'),
				'parent_item'       => __('Родительский тип заказа'),
				'parent_item_colon' => __('Родительский тип заказа:'),
				'edit_item'         => __('Редактировать тип заказов'),
				'update_item'       => __('Обновитиь тип заказов'),
				'add_new_item'      => __('Добавить тип заказов'),
				'new_item_name'     => __('Новый тип заказов'),
				'menu_name'         => __('Категория заказов'),
		),
			'show_ui'       => true,
			'query_var'     => true,
			'rewrite'       => null,
		)
	);
}

	// Создаем таксономию "Тип заказов" для постов типа "property"
add_action( 'init', 'view_property_taxonomies' );
		function view_property_taxonomies(){		
	// Добавляем древовидную таксономию 'Метки заказов' (метки)
		register_taxonomy('view', array ('property'),array(
			'hierarchical'  => false,
			'labels'        => array(
				'name'              => _x('Метки', 'taxonomy general name'),
				'singular_name'     => _x('Метки ', 'taxonomy singular name'),
				'search_items'      =>  __( 'Поиск по меткам'),
				'popular_items'     =>  __('Популярные Метки'),
				'all_items'         =>  __('Все метки'),
				'parent_item'       => null,
				'parent_item_colon' => null,
				'edit_item'         => __('Редактировать метки заказа'),
				'update_item'       => __('Обновитиь метки заказов'),
				'add_new_item'      => __('Добавить метки заказа'),
				'new_item_name'     => __('Новая метка заказа'),
				'menu_name'         => __('Метки заказов'),
			),
			'show_ui'       => true,
			'query_var'     => true,
			'rewrite'       => null,
		)
	);
}	

	//вывод таксономий
		function custom_taxnomomy (){
			$cats = get_the_terms($post->ID, 'deal');
			foreach( $cats as $cat ){	
				echo $parent ='<a href="'. get_term_link((int)$cat->term_id) .'">'. $cat->name .'</a>';
		}	
}

	// Пользовательские уведомления нового типа записей
add_filter( 'post_updated_messages', 'true_post_type_messages' ); 
		function true_post_type_messages($messages) {
			global $post, $post_ID; 
			$messages['property'] = array( // property - название созданного нами типа записей
				0 => '', // Данный индекс не используется.
				1 => sprintf( 'Объявление обновлено. <a href="%s">Просмотр</a>', esc_url( get_permalink($post_ID) ) ),
				2 => 'Параметр обновлён.',
				3 => 'Параметр удалён.',
				4 => 'Объявление обновлено',
				5 => isset($_GET['revision']) ? sprintf( 'Объявление восстановлено из редакции: %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
				6 => sprintf( 'Объявление опубликовано на сайте. <a href="%s">Просмотр</a>', esc_url( get_permalink($post_ID) ) ),
				7 => 'Объявление сохранено.',
				8 => sprintf( 'Отправлено на проверку. <a target="_blank" href="%s">Просмотр</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
				9 => sprintf( 'Запланировано на публикацию: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Просмотр</a>', date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
				10 => sprintf( 'Черновик обновлён. <a target="_blank" href="%s">Просмотр</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
			); 
			return $messages;
}

	// регистрирует тип записей Водители (record type The property)
add_action( 'init', 'register_post_types_2' );
	function register_post_types_2(){
		register_post_type('drivers', array(
			'label'  => null,
			'labels' => array(
				'name'               => 'Водители службы "ЯЕду"', // основное название для типа записи
				'singular_name'      => 'Водитель', // название для одной записи этого типа
				'add_new'            => 'Добавить водителя', // для добавления новой записи
				'add_new_item'       => 'Добавление водителя', // заголовка у вновь создаваемой записи в админ-панели.
				'edit_item'          => 'Редактирование водителя', // для редактирования типа записи
				'new_item'           => 'Новый водитель', // текст новой записи
				'view_item'          => 'Смотреть водителя', // для просмотра записи этого типа.
				'search_items'       => 'Искать водителя', // для поиска по этим типам записи
				'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
				'not_found_in_trash' => 'Не найдено в выбранных', // если не было найдено в корзине
				'parent_item_colon'  => 'Водители', // для родителей (у древовидных типов)
				'menu_name'          => 'Водители таксопарка "ЯЕду"', // название меню
			),
			'description'         => 'водители таксопарка "ЯЕду"',
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 4,
			'menu_icon'           => null,
			'show_in_nav_menus'   => true,
			'supports'            => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'),
			'taxonomies'          => array('deal','view'),
			'has_archive'         => true,
			'rewrite'             => true,
			'can_export'		  => true,
			'delete_with_user'	  => true,
		) );
	}

	// Создаем таксономию "Тип объявления" для постов типа "drivers"
			add_action('init', 'deal_drivers_taxonomy');
			function deal_drivers_taxonomy(){

	// Добавляем древовидную таксономию 'deal' (категории)
		register_taxonomy('deal_drivers', array('drivers'), array(
			'hierarchical'  => true,
			'labels'        => array(
				'name'              => _x('Категория Водителя', 'taxonomy general name'),
				'singular_name'     => _x('Категория водителя', 'taxonomy singular name'),
				'search_items'      =>  __('Поиск типа водителя'),
				'all_items'         => __('Все водители'),
				'parent_item'       => __('Родительский тип водителя'),
				'parent_item_colon' => __('Родительский тип водителя:'),
				'edit_item'         => __('Редактировать тип водителя'),
				'update_item'       => __('Обновитиь тип водителя'),
				'add_new_item'      => __('Добавить тип водителя'),
				'new_item_name'     => __('Новый тип водителей'),
				'menu_name'         => __('Категория водителей'),
			),
			'show_ui'       => true,
			'query_var'     => true,
			'rewrite'       => null,
		)
	);
}	
	//вывод таксономий
		function custom_taxnomomy_drivers(){
			$cats = get_the_terms($post->ID, 'deal_drivers');
			foreach( $cats as $cat ){	
				echo $parent ='<a href="'. get_term_link((int)$cat->term_id) .'">'. $cat->name .'</a>';
		}	
}
	// Пользовательские уведомления нового типа записей
add_filter( 'post_updated_messages', 'true_post_type_messages' );
		function true_post_type_messages_drivers($messages) {
			global $post, $post_ID; 
			$messages['drivers'] = array( // drivers - название созданного нами типа записей
				0 => '', // Данный индекс не используется.
				1 => sprintf( 'Объявление обновлено. <a href="%s">Просмотр</a>', esc_url( get_permalink($post_ID) ) ),
				2 => 'Параметр обновлён.',
				3 => 'Параметр удалён.',
				4 => 'Объявление обновлено',
				5 => isset($_GET['revision']) ? sprintf( 'Объявление восстановлено из редакции: %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
				6 => sprintf( 'Объявление опубликовано на сайте. <a href="%s">Просмотр</a>', esc_url( get_permalink($post_ID) ) ),
				7 => 'Объявление сохранено.',
				8 => sprintf( 'Отправлено на проверку. <a target="_blank" href="%s">Просмотр</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
				9 => sprintf( 'Запланировано на публикацию: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Просмотр</a>', date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
				10 => sprintf( 'Черновик обновлён. <a target="_blank" href="%s">Просмотр</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
			); 
			return $messages;
		}

	// добавляем колонку "ID" в админке
add_action('admin_init', 'admin_area_ID');
		function admin_area_ID() {
	// для таксономий (рубрик, меток и т.д.)
			foreach (get_taxonomies() as $taxonomy) {
add_action("manage_edit-${taxonomy}_columns", 'tax_add_col');
add_filter("manage_edit-${taxonomy}_sortable_columns", 'tax_add_col');
add_filter("manage_${taxonomy}_custom_column", 'tax_show_id', 10, 3);
  }
add_action('admin_print_styles-edit-tags.php', 'tax_id_style');
		function tax_add_col($columns) {return $columns + array ('tax_id' => 'ID');}
		function tax_show_id($v, $name, $id) {return 'tax_id' === $name ? $id : $v;}
		function tax_id_style() {print '<style>#tax_id{width:4em}</style>';}

	// для постов и страниц
add_filter('manage_posts_columns', 'posts_add_col', 5);
add_action('manage_posts_custom_column', 'posts_show_id', 5, 2);
add_filter('manage_pages_columns', 'posts_add_col', 5);
add_action('manage_pages_custom_column', 'posts_show_id', 5, 2);
add_action('admin_print_styles-edit.php', 'posts_id_style');
		function posts_add_col($defaults) {$defaults['wps_post_id'] = __('ID'); return $defaults;}
		function posts_show_id($column_name, $id) {if ($column_name === 'wps_post_id') echo $id;}
		function posts_id_style() {print '<style>#wps_post_id{width:4em}</style>';}
}

	// открываем к проходу архив ТИПА ЗАПИСИ  - но НЕ ИНДЕКСУ роботами
add_action('wp_head', 'view_property_taxonomies_robots');
		function view_property_taxonomies_robots () {
		if (is_post_type_archive( 'Тип заказов' )) { 
		echo "".'<meta name="robots" content="noindex,follow" />'."\n";
	} 
}
	
	// Определяем размер миниатюр по умолчанию
add_theme_support( 'post-thumbnails' );
	
	//функция вывода записей типа 'property' 
	 	function property_custom_posts() {
			$args = array(
				'post_type' => 'property',
				'view' => $term->slug );
			$query = new WP_Query( $args );
			if ($query->have_posts()) {
						while ( $query->have_posts() ) : $query->the_post(); 					
					 get_template_part('content-min',''); 			
				   endwhile; 
						echo '</ul>';	
		} 
		wp_reset_postdata();
}
	//обрезаем длину анонса
add_filter( 'excerpt_length', function(){
	return 20;
});

	//скрытый контент от незарегистрированных [dostup_only][/dostup_only]
add_shortcode( 'dostup_only', 'dostup_only_shortcode' );
		function dostup_only_shortcode( $atts, $content = null ) {
			if ( is_user_logged_in() && !empty( $content ) && !is_feed() )  {
					return do_shortcode($content); //$content; если скрываем контент
					}
			return '';
    }
	
	//скрытый контент от зарегистрированных [guest][/guest]
add_shortcode('guest', 'guest_check_shortcode');
		function guest_check_shortcode( $atts, $content = null ) {
			if ( !is_user_logged_in() && !is_null( $content ) && !is_feed() )
				return $content;
				return '';
}
	// Безопасность
		remove_action( 'wp_head', 'wp_generator');
		remove_action( 'wp_head', 'index_rel_link' );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'previous_post_rel_link', 10, 0);
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', '_ak_framework_meta_tags');
		
	//Убрать версию WordPress из шапки и rss-лент:
		function complete_version_removal() {
	return '';
}
add_filter('the_generator', 'complete_version_removal');

	//Совмещаем Google ReCaptcha с формой регистрации WP-Recall
add_action('register_form','rcl_add_google_captcha_register_form');
		function rcl_add_google_captcha_register_form(){
    echo '<div class="g-recaptcha" data-sitekey="***************************"></div>';
}

add_filter('registration_errors','rcl_chek_google_captcha_form',10);
		function rcl_chek_google_captcha_form($errors){
    
    $recaptcha_response = sanitize_text_field($_POST["g-recaptcha-response"]);
    $recaptcha_secret = '************************';
     $response = wp_remote_get("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$recaptcha_response);
    $response = json_decode($response["body"], true);
	
    if (isset($response['error-codes']) && $response['error-codes']) {
        $errors = new WP_Error();
        $errors->add( 'rcl_register_google_captcha', __('Проверка Google reCAPTCHA не пройдена!') );
    }
    
    return $errors;
}