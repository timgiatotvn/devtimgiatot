<script>
    console.error('1234567890')
    function sayHello() {
        var list_link = document.getElementsByTagName('a');
        var els = document.getElementsByTagName("a");
        for (let i = 0; i < list_link.length; i++) {
            let hrefOld = JSON.parse(JSON.stringify(list_link[i].href));
            if(hrefOld.search("https://tiki.vn")>=0){
                console.error('Có địa chỉ từ tiki: ở vị trí: ' + i)
                console.error('địa chỉ là:' + hrefOld);
                list_link[i].href = 'https://ti.ki/lLoCiS7e/OR60D8CM?TIKI_URI='+hrefOld+'&utm_term=TAPO.TIKI';
                console.error(list_link[i])
            }
        }
    }
    setTimeout ( sayHello , 500 );
</script>