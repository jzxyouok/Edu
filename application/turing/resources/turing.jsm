function sendBack(question){
    $.ajax({
        type: "GET",
        url: "#{base}/public/index.php/turing/turing/talk",
        data: {"message":question},
        dataType: "json",
        success: function(data){
            #{callback}(data.content);
        }
    });
}