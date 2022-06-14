require('dotenv').config();
const cheerio = require('cheerio');
const request = require('request-promise');
const express = require('express');
const syncRequest = require('sync-request');
const app = express();
const bodyParser = require('body-parser');
const cors = require('cors');
const port = process.env.APP_POST;

//define
var lst = [];
var lstArticle = [];

app.use(bodyParser.urlencoded({extended: false}));
app.use(bodyParser.json());
app.use(cors());

function returnStatus(rt_res, rt_status, rt_message, rt_response) {
    rt_res.status(rt_status)
    rt_res.json({
        'meta': {
            'status': rt_status,
            'message': rt_message,
        },
        'response': rt_response
    });
}

sleep = (ms) => {
    return new Promise(rs => setTimeout(rs, ms));
}

app.post('/crawler-data', (req, res) => {
    if (typeof req.header("app-pass") != 'undefined') {
        if (req.header("app-pass") === process.env.API_PASS) {
            lst = [];
            lstArticle = [];
            crawlerListData(req.body, "all")
            returnStatus(res, 200, "Success", true);
        } else {
            console.log("Fail header other")

            returnStatus(res, 500, "Fail header other", false);
        }
    } else {
        console.log("Fail header null")

        returnStatus(res, 500, "Fail header null", false);
    }
});

app.post('/crawler-data-demo', (req, res) => {
    console.log("crawler-data-demo")
    if (typeof req.header("app-pass") != 'undefined') {
        if (req.header("app-pass") === process.env.API_PASS) {
            lst = [];
            lstArticle = [];
            crawlerListData(req.body, "first")
            returnStatus(res, 200, "Success", true);
        } else {
            console.log("Fail header other")

            returnStatus(res, 500, "Fail header other", false);
        }
    } else {
        console.log("Fail header null")

        returnStatus(res, 500, "Fail header null", false);
    }
});

sleep = (ms) => {
    return new Promise(rs => setTimeout(rs, ms));
}

async function crawlerListData(data, quantity) {
    console.log("Turn 1 crawlerListData")
    const res = syncRequest('GET', data.url.toString());
    try {
        const $ = cheerio.load(res.getBody('utf8'));
        const container = $(data.class_root_list.toString() + " " + data.class_parent.toString());

        //crawler quantity record
        var num = container.length
        if (quantity == "first") {
            if (num != 0) {
                num = 1
            }
        }

        //crawler record
        for (let i = 0; i < num; i++) {
            const dom = $(container[i]);

            //define
            const href = dom.find(data.class_url_a.toString()).attr("href")
            var thumb = dom.find(data.class_url_image.toString() + " img").attr(data.class_url_image_attr.toString())
            if(thumb == "" || typeof thumb == "undefined") {
                thumb = dom.find(data.class_url_image.toString() + " img").attr("src")
            }
            if(thumb == "" || typeof thumb == "undefined") {
                thumb = dom.find(data.class_url_image.toString() + " img").attr("data-src")
            }

            var dm = href
            if(typeof data.domain_url != "undefined" && data.domain_url != "" && data.domain_url != "null" && data.domain_url !== null){
                dm = data.domain_url + href
            }

            //merge data
            lst.push({
                thumb: thumb,
                href: dm,
                crawler_category_id: data.id,
                class_detail: data.class_detail,
                class_detail_name: data.class_detail_name,
                class_detail_price: data.class_detail_price,
                class_detail_price_root: data.class_detail_price_root,
                class_detail_content: data.class_detail_content,
                class_detail_description: data.class_detail_description
            });
            if (quantity == "first") break;
        }

        if (lst.length == num) {
            console.log("Turn 2 crawlerDetail")
            crawlerDetail(lst, quantity)
        }
    } catch (ex) {
        //console.log(ex);
        console.log("crawlerListData Fail");
    }

    await sleep(3000);
}

async function crawlerDetail(data, quantity) {
    for (let k = 0; k < data.length; k++) {
        const row = data[k];
        const res = syncRequest('GET', row.href);
        try {
            const $ = cheerio.load(res.getBody('utf8'));
            const container = $(row.class_detail.toString());

            for (let i = 0; i < container.length; i++) {
                const dom = $(container[i]);

                //define
                const name = dom.find(row.class_detail_name).text()
                const price = dom.find(row.class_detail_price).text()
                const price_root = dom.find(row.class_detail_price_root).text()
                const description = dom.find(row.class_detail_description).html()
                const content = dom.find(row.class_detail_content).html()

                lstArticle.push({
                    crawler_category_id: row.crawler_category_id,
                    thumb: row.thumb,
                    href: row.href,
                    name: name,
                    price: price,
                    price_root: price_root,
                    // description: "",
                    // content: ""
                    description: description,
                    content: content
                });
            }

            if (lstArticle.length === data.length) {
                console.log("Turn 2 saveArticle")
                saveArticle(lstArticle, quantity)
            }

        } catch (ex) {
            // console.log(ex);
            console.log("crawlerDetail Fail");
        }
    }

    await sleep(5000);
}

async function saveArticle(data, quantity) {

    var url_store = process.env.URL_HOST + 'article/store'
    var type = "crawler"
    if (quantity == "first") type = "demo"

    for (let i = 0; i < data.length; i++) {
        const row = data[i]
        
        try{
            if (typeof row.name != "undefined" && typeof row.thumb != "undefined") {
                const options = {
                    url: url_store,
                    method: 'POST',
                    formData: {
                        'crawler_category_id': row.crawler_category_id,
                        'name': row.name,
                        'thumb': row.thumb,
                        'href': row.href,
                        'price': row.price,
                        'price_root': row.price_root,
                        'description': row.description,
                        'content': row.content,
                        'type': type
                    },
                    headers: {
                        'User-Agent': 'request',
                        'app-pass': process.env.API_PASS,
                    }
                };
                await request(options).then(function (res) {
                    console.log("Update success")
                }).catch(function (err) {
                    //console.log(err)
                    console.log("Update fail")
                });
            }
        } catch (ex) {
            // console.log(ex);
            console.log("saveArticle Fail");
        }
    }
}

app.listen(port, () => console.log(`Port ${port}!`))