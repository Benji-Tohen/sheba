
	* {
		margin: 0;
		padding: 0;
		font-family: 'Oswald', sans-serif;
	}
	.navbar-default-new{
		background-color: #fff;
	}
	.link_menu_new{
		color: #161e72;
		font-size: 20px;
		font-weight: 700;
	}
	.navbar-nav-new{
		list-style: none;
	}
	body {
		background: url(../images/texture_green_cup.jpg);
	}
	
	img {
		display: block;
		height: auto;
	}
	

	.content {
		width: 80%;
		margin: 50px auto;
		padding: 20px;
	}
	.content h1 {
		font-weight: 400;
		text-transform: uppercase;
		margin: 0;
		color: #fff;
	}
	.content h2 {
		font-weight: 400;
		text-transform: uppercase;
		color: #333;
		margin: 0 0 20px;
	}
	.content p {
		font-size: 1em;
		font-weight: 300;
		line-height: 1.5em;
		margin: 0 0 20px;
	}
	.content p:last-child {
		margin: 0;
	}
	.content a.button {
		display: inline-block;
		padding: 10px 20px;
		background: #ff0;
		color: #000;
		text-decoration: none;
	}
	.content a.button:hover {
		background: #000;
		color: #ff0;
	}
	.content.title {
		position: relative;
		background: #333;
	}
	.content.title h1 span.demo {
		display: inline-block;
		font-size: .5em;
		padding: 10px;
		background: #fff;
		color: #333;
		vertical-align: top;
	}
	.content.title .back-to-article {
		position: absolute;
		bottom: -20px;
		left: 20px;
	}
	.content.title .back-to-article a {
		padding: 10px 20px;
		background: #f60;
		color: #fff;
		text-decoration: none;
	}
	.content.title .back-to-article a:hover {
		background: #f90;
	}
	.content.title .back-to-article a i {
		margin-left: 5px;
	}
	.content.white {
		background: #fff;
		box-shadow: 0 0 10px #999;
	}
	.content.black {
		background: #000;
	}
	.content.black p {
		color: #999;
	}
	.content.black p a {
		color: #08c;
	}
	
	
	.dropdown-menu {
		min-width: 200px;
	}
	.dropdown-menu.columns-2 {
		min-width: 400px;
	}
	.dropdown-menu.columns-3 {
		min-width: 600px;
	}
	.dropdown-menu li a {
		padding: 5px 15px;
		font-weight: 300;
	}
	.multi-column-dropdown {
		list-style: none;
	}
	.multi-column-dropdown li a {
		display: block;
		clear: both;
		line-height: 1.428571429;
		color: #333;
		white-space: normal;
	}
	.multi-column-dropdown li a:hover {
		text-decoration: none;
		color: #262626;
		background-color: #f5f5f5;
	}

	@media (max-width: 767px) {
		.dropdown-menu.multi-column {
			min-width: 240px !important;
			overflow-x: hidden;
		}
	}
	
	@media (max-width: 480px) {
		.content {
			width: 90%;
			margin: 50px auto;
			padding: 10px;
		}
	}

