function get_data() {
    $.ajax({
        url: "search",
        dataType: "json",
        success: data => {
            console.log(data);
        },
        error: () => {
            alert("ajax Error");
        }
    });
}