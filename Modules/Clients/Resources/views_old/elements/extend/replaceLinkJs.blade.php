<script>
    console.error('Check link:')
    function replaceUrlTagLink() {
        var list_link = document.getElementsByTagName('a');
        for (let i = 0; i < list_link.length; i++) {
            let hrefOld = JSON.parse(JSON.stringify(list_link[i].href));
            if(hrefOld.search("https://tiki.vn")>=0){
                list_link[i].href = 'https://ti.ki/lLoCiS7e/OR60D8CM?TIKI_URI='+hrefOld+'&utm_term=TAPO.TIKI';
            }
        }
    }
    setTimeout ( replaceUrlTagLink , 500 );
</script>