<?php

function postListapi($param){
    
    echo "
    <style>

    #post-img{
        object-fit:".$param['object_fit'].";
        object-position:".$param['object_fit_position']."
    }

    .post_link{
        text-decoration:none;
    }
    .post_link:hover{
        text-decoration:none;
    }

    @media (max-width: 34em) {
        .card-columns {
            -webkit-column-count:1;
            -moz-column-count:1;
            column-count:1;
        }
    }

    @media (min-width: 34em) {
        .card-columns {
            -webkit-column-count:1;
            -moz-column-count:1;
            column-count:1;
        }
    }

    @media (min-width: 48em) {
        .card-columns {
            -webkit-column-count:2;
            -moz-column-count:2;
            column-count:2;
        }
    }

    @media (min-width: 62em) {
        .card-columns {
            -webkit-column-count:3;
            -moz-column-count:3;
            column-count:3;
        }
    }

    @media (min-width: 75em) {
        .card-columns {
            -webkit-column-count:".$param['per_ligne'].";
            -moz-column-count:".$param['per_ligne'].";
            column-count:".$param['per_ligne'].";
        }
    }

    </style>
    ";

    echo "
    <div id='postList' 
    apiUrl_fr='".$param['site_url_fr']."' 
    apiUrl_en='".$param['site_url_en']."' 
    totalPost='".$param['total_post']."'
    perLigne='".$param['per_ligne']."'
    language='".get_bloginfo("language")."'
    > 

    <div>
     <div class='card-columns' id='row-grid' style='
     flex-wrap: inherit !important;'>
       <div style='text-align:center'></div>
     </div>
    </div>
    
    </div>
";
;?>
<script type="text/javascript" src="<?php echo plugin_dir_url( __DIR__ ).'/grid/post_listing.js';?>"></script>
<?php
}