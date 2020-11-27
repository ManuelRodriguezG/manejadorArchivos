
<style type="text/css">
.a-bg{
    background:transparent;
}
@font-face {
  font-family: "Free Script";
  src: url("fonts/FREESCPT.TTF");
}
@font-face {
  font-family: "Lato";
  src: url("fonts/header/Karla-Regular.ttf");
}
.navigation-link{

    color:black !important;
}
.navigation-nav{
    padding:0 !important;
}

/*arrow dropdown*/

/*after*/


/*before*/
.navbar-nav .dropdown-menu{
    position: sticky !important;
}
@media (min-width: 992px){
    .navbar-expand-lg .navbar-nav .dropdown-menu{
        position: absolute !important;
    }
}
.dropdown-menu{
    background-color: #b0ded3 !important;
}
.dropdown-menu:after{
    content:"";
    height:0;
    width:0;
    display:block;
    position:absolute;
    pointer-events:none;
    margin-right: auto;
    left: 50%;

    bottom: 100%;
    border-bottom:7px solid #b0ded3;
    border-right:7px solid transparent;
    border-left:7px solid rgba(0, 0, 0, 0);  
    border-top:7px solid rgba(0, 0, 0, 0);  
}
.label-nav{
    font-size: 15px;
    cursor:pointer;
    transition: 2s;
    margin:0px;
}
#logo-page{
    width: 80px;
}
.logo-page-big{
    width: 100px !important; 
}
.header-navbar-transparent{
    background: transparent;
}
.header-navbar-transparent .link-header-navbar{
    color: black !important;
}
.header-navbar-color{
    background: white;
}
.header-navbar-dark{
    background: black;
}
.header-navbar-dark .link-header-navbar{
    color: white !important;
}
.header-navbar-dark .link-header-navbar-sub{
    color: black !important;
    position: relative;
    text-align: center;
}
.header-navbar{
    transition: 2s
}
/* toogle menu*/
.container-toogle-menu{
    position: relative;
}
.line-1-toogle-menu-dark{
    width: 40px;
    background: #000000b8;
    height: 5px;
    margin:5px;
    border-radius: 5px;
}
.line-2-toogle-menu-dark{
    width: 30px;
    background: #000000b8;
    height: 5px;
    margin:5px;
    border-radius: 5px;
    position: relative;
    left: 5px;
}
.line-1-toogle-menu-light{
    width: 40px;
    background: #ffffffb8;
    height: 5px;
    margin:5px;
    border-radius: 5px;
}
.nav-item:hover{
    background: #00000047;
    
}
.line-2-toogle-menu-light{
    width: 30px;
    background: #ffffffb8;
    height: 5px;
    margin:5px;
    border-radius: 5px;
    position: relative;
    left: 5px;
}
.btn-toogle-menu{
    background: transparent;
    border:none !important;
}
.btn-toogle-menu{
    outline: none !important;
}
.header-navbar{
    z-index: 5;
}
.header-navbar-dark .link-header-navbar-sub:hover{
    background: #ffffffa6 !important;

}
.header-navbar-dark .link-header-navbar-sub::before{
    content:"";
    position: absolute;
    bottom: 0%;
    left: 37%;
    width:25%;
    height: 1px;
    background: black;
    display: block;
    -webkit-transform-origin:right top;
    -ms-transform-origin:right top;
    -webkit-transform:scale(0, 1);
    -ms-transform:scale(0, 1);
    -webkit-transition:transform 0.4s cubic-bezier(1, 0, 0, 1);
    transition:transform 0.4s cubic-bezier(1, 0, 0, 1);
}
.header-navbar-dark .link-header-navbar-sub:hover::before{

    -webkit-transform-origin:left top;
    -ms-transform-origin:left top;
    transform-origin:left top;
    -webkit-transform:scale(1, 1);
    -ms-transform:scale(1, 1);
    transform:scale(1, 1);
}
</style>
<div class="container">
    <header class="header-navbar sticky-top header-navbar-color" style="font-family: Lato;">
        <nav class="navbar navbar-expand-lg navbar-light a-bg navigation-nav">


            <div class=" navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link link-header-navbar navigation-link" href="#">
                            <label class="label-nav">Inicio</label>
                        </a>
                    </li>    
                    <li class="nav-item active">
                        <a class="nav-link link-header-navbar navigation-link" href="#">
                            <label class="label-nav" id="create_folder">Crear Carpeta</label>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sticky-top navigation-link link-header-navbar" href="#">
                            <label class="label-nav" id="upload_file">Subir Archivo</label>
                        </a>
                    </li>


                </ul>

            </div>
        </nav>
    </header>
</div>


