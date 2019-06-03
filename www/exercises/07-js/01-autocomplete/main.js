document.addEventListener("DOMContentLoaded", function(e) {
    let searchbox = document.getElementById("country");

    searchbox.addEventListener("keyup", function(e) {
        // console.log(e);
        //console.log(searchbox.value);

        if (searchbox.value.length >= 2) {
            $.ajax({
                method: "GET",
                url: "search.php?search=" + searchbox.value,
                //data: { search: "Harley" }
            })
                .done(function(remote_suggestions) {
                    addSuggestions(remote_suggestions);
                });
        }
        
    });

    $("#suggestions").on("click", "a", function(e) {
        e.preventDefault();

        searchbox.value = $(this)[0].innerText;
    });

    function addSuggestions(suggestions) {
        let suggestions_parent = document.getElementById("suggestions");
        $("#suggestions").empty();

        suggestions.forEach(function(item) {
            let element_li = document.createElement("li");
            let element_a = document.createElement("a");
    
            element_a.setAttribute("href", "#");
            element_a.innerText = item;
    
            element_li.append(element_a);
    
            suggestions_parent.append(element_li);
        });
    }
});
