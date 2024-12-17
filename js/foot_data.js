function dataf() {
    $.post("/data/getdata", { data: "2" }, function (data, status) {
        if (data != "") {
            document.getElementById("ftdata").innerHTML = data;
        }
    });
}
dataf(); 