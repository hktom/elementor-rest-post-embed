$(function() {
    var api_url_en = $("#postList").attr("apiUrl_en");
    var api_url_fr = $("#postList").attr("apiUrl_fr");
    var total_post = $("#postList").attr("totalPost");
    var language = $("#postList").attr("language");
    var calendar_en = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var calendar_fr = ["Jan", "Fev", "Mar", "Avr", "Mai", "Juin", "Jui", "Août", "Sep", "Oct", "Nov", "Dec"];
    var posts = [];
    var htmlContent = "";

    if (language == "en-US") {
        var api_url = api_url_en;
        var calendar = calendar_en;
        var dateText = "Published date";
        var authorText = "Author";
        var buttonText = "Read more";
    } else {
        var api_url = api_url_fr;
        var calendar = calendar_fr;
        var dateText = "Date de publication";
        var authorText = "Auteur";
        var buttonText = "Lire la suite";
    }
    console.debug(api_url, language);

    // get posts from url
    function getPost(url, post_type) {
        $.get(`${url}${post_type}?_embed=wp:featuredmedia,wp:term&per_page=${total_post}`, function(res) {
            posts = res;
            if (post_type == "use_case") {
                listUseCase(posts);
            } else {
                listPost(posts);
            }
            console.log('success', res);
        }).fail(function(err) {
            console.log('$Error', err);
        });
    }

    function convertDate(mydate) {
        var _date = new Date(mydate);
        var day = _date.getDate();
        var month = _date.getMonth();
        var year = _date.getFullYear();
        return `${day} ${calendar[month]} ${year}`;
    }

    // List Post
    function listPost(data) {
        var postGrid = $("#row-grid");
        data.map((item, key) => {
            //date 
            var _date = convertDate(item["date"]);
            var _img = '';
            var _linkImg = item["_embedded"]["wp:featuredmedia"][0]["media_details"];

            try {
                _img = _linkImg["sizes"]["large"]["source_url"]
            } catch (error) {
                _img = _linkImg["sizes"]["full"]["source_url"];
            }


            htmlContent += `
            <div class="card post-bg-color my-2" style="border:none;border-radius: 0rem !important;">
                <a href="${item.link}"><img id="post-img" class="post-img-height post-img-width" src="${_img}" alt="Card image cap"></a>

                <div class="card-body">
                <h5 class="card-title post-title-font post-title-color">
                ${item.title.rendered}
                </h5>
                
                <p class="my-2 post-meta-font post-meta-color"> 
                ${dateText}: <span> ${_date} </span> <br/>
                ${item["acf"]['auteur']?authorText:''}: <span> ${item["acf"]['auteur']} </span> 
                </p>

                <div class="my-1">
                <p class="post-description-font post-description-color">
                ${item["acf"]['chapeau']}</p> 
                </div>

                <div class="my-1"> <a href="${item.link}" target="_blank" class="post_link post-button-font post-button-bg-color post-button-color">  ${buttonText} </a> </div>

                </div>
            </div>
            `;


        })


        postGrid.html(htmlContent);
        console.log("List Post");
    }

    function listUseCase(data) {
        var postGrid = $("#row-grid");
        data.map((item, key) => {
            //date 
            var _date = convertDate(item["modified"]);
            var _img = '';
            var _linkImg = item["_embedded"]["wp:featuredmedia"][0]["media_details"];

            try {
                _img = _linkImg["sizes"]["large"]["source_url"];
            } catch (error) {
                _img = _linkImg["sizes"]["full"]["source_url"];
            }


            htmlContent += `
            <div class="card post-bg-color my-2" style="border:none;border-radius: 0rem !important;">
                <a href="${item.link}"><img id="post-img" class="post-img-height post-img-width" src="${_img}" alt="Card image cap"></a>

                <div class="card-body">
                <h5 class="card-title post-title-font post-title-color">
                ${item.title.rendered}
                </h5>
                
                <p class="my-2 post-meta-font post-meta-color"> 
                ${dateText}: <span> ${_date} </span> <br/>
                </p>

                <div class="my-1">
                <p class="post-description-font post-description-color">
                ${item["acf"]['chapeau']}</p> 
                </div>

                <div class="my-1"> <a href="${item.link}" target="_blank" class="post_link post-button-font post-button-bg-color post-button-color">  ${buttonText} </a> </div>

                </div>
            </div>
            `;


        })


        postGrid.html(htmlContent);
        console.log("List Post");
    }

    getPost(api_url, 'posts');
    getPost(api_url, 'tech_voices');
    getPost(api_url, 'use_case');

});