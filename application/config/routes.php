<?php

$authorization['any'] = array(

						'home' => array
								( 
									'index' => true
								),

						'docs' => array
								( 
									'index' => true,
									//'modules'=>true,
									//'models'=>true,
									//'views'=>true,
									//'services'=>true,
									//'config'=>true,
								),

);


$authorization['user_defined_class'] = array(

	'home' => array
			( 
				'authorized_only'=>true
			)
); 

									
