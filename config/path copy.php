<?php 
// include_once('./url.php');
// define("_FILE", __DIR__);
define("_HOST", "https://localhost/");
define("_SITE", "NSC/");
    define("_WEBSITE", _HOST._SITE);
        define("_CONTROLLER", _WEBSITE."Controller/");
            define("_CRL_MEMBER",_CONTROLLER.'Crl_member/');
            define("_CRL_ADMIN",_CONTROLLER.'Crl_Admin/');
        define("_DATABASE", _WEBSITE.'Database/');
            define("_IMAGE", _DATABASE."image/");
        define("_CONFIG", _WEBSITE."Config/");
        define("_MODEL", _WEBSITE."Model/");
        define("_SCRIPT", _WEBSITE."Script/");
            define("_CSS", _SCRIPT."css/");
            define("_JQUERY", _SCRIPT."jquery/");
            define("_JS", _SCRIPT."js/");
            define("_PYTHON", _SCRIPT."python/");
                define("_PCA", _PYTHON."PCA/");
                    define("_DATASETS", _PCA."datasets/");
                        define("_FACES", _DATASETS."faces/");
        define("_VIEW", _WEBSITE."View/");
            define("_ADMIN", _VIEW."Admin/");
                define("_ROOM_MANAGEMENY",_ADMIN."Room_management/");
                define("_MEMBER_MANAGEMENY",_ADMIN."Member_management/");
                
            define("_MAIN_LOGIN", _VIEW."Main_Login/");
            define("_MEMBER", _VIEW."Member/");
                define("_FACESAVE", _MEMBER."FaceSave/");
            define("_REGISTER", _VIEW."Register/");
?>