<!DOCTYPE html>
<html lang="en">

@include('head')

<body>

    @include('header')

    @if (Auth::check())
    @include('nav')
    @endif

    <div class="container">

        <p class="no-results">You have not added any keywords.</p>

        <main class="criteria">
            <section class="keywords-section">
                <div class="keyword-controls">
                    <h2 class="keywords-section-title">Keywords</h2>
                    <input type="text" id="keyword-input" class="input is-small is-rounded"
                        placeholder="Type keyword..">
                    <button id="btn-add-keyword" class="button is-small is-success is-rounded">Add Keyword</button>
                </div>
                <button id="btn-del-keywords" class="button is-small is-rounded is-danger has-text-weight-bold"
                    style="visibility:hidden;margin-bottom:10px;">Delete Selected
                    (<span id="selected-count"></span>)</button>
                <ul id="keywords-list">

                </ul>
            </section>
        </main>

    </div>

    @include('footer')

    @include('loading')
</body>

<script>
    function GetUserKeywords() {
    $(".lds-dual-ring, .loading-overlay").show()

    $.ajax({
        url: "https://ycurator.test/api/user-keywords",
        method: "GET",
        dataType: "json",
        data: { userID: userID },
        success: function (res) {
            $(".lds-dual-ring, .loading-overlay").hide()
            if (res.length === 0) {
                $(".no-results").show()
            }

            var keywordsList = $("#keywords-list")
            keywordsList.empty()

            res.forEach(function (obj, index) {
                var keyword = $("<li>").addClass("keyword").attr("id", "keyword_" + obj.id).data("keyword_id", obj.id).text(obj.keyword)
                
                keyword.on("click", function (e) {
                    if (!selectedKeywords.includes($(this).data("keyword_id"))) {
                        selectedKeywords.push($(this).data("keyword_id"))
                        $(this).addClass("keyword__selected")
                    } else {
                        selectedKeywords.splice(selectedKeywords.indexOf($(this).data("keyword_id")), 1)
                        $(this).removeClass("keyword__selected")
                    }
                    // Display delete btn if keywords are selected
                    selectedKeywords.length ? $("#btn-del-keywords").css("visibility", "visible") : $("#btn-del-keywords").css("visibility", "hidden")
                    // Update the selected count to display in the delete button's text
                    $("#selected-count").text(selectedKeywords.length)
                })
                keywordsList.append(keyword)
            })
            console.log(res)
        },
        error: function (err) {
            $(".lds-dual-ring, .loading-overlay").hide()
            console.log(err)
        }
    })
}


// List of keywords the user has selected (for deleting keywords)
var selectedKeywords = []

$(document).ready(function () {

    console.log("USER ID", userID)

    $("#btn-add-keyword").on("click", function (e) {
        $.ajax({
            url: "https://ycurator.test/api/user-keywords",
            method: "POST",
            data: { userID: userID, keyword: $("#keyword-input").val() },
            success: function (res) {
                console.log(res)
                location.reload()
            },
            error: function (err) {
                alert("Error occurred when trying to add keyword.")
                console.log(err)
            }
        })
    })

    $("#keyword-input").on("keypress", function (e) {
        if (e.which === 13 && $(this).val() !== "") {
            $.ajax({
                url: "https://ycurator.test/api/user-keywords",
                method: "POST",
                data: { userID: userID, keyword: $("#keyword-input").val() },
                success: function (res) {
                    console.log(res)
                    location.reload()
                },
                error: function (err) {
                    alert("Error occurred when trying to add keyword.")
                    console.log(err)
                }
            })
        }
    })

    $("#btn-del-keywords").on("click", function(e) {
        $.ajax({
            url: "https://ycurator.test/api/user-keywords",
            method: "DELETE",
            data: { keywordIDList: selectedKeywords },
            success: function(res) {
                console.log(res)
                location.reload()
            },
            error: function(err) {
                alert("Error occurred when trying to delete keyword(s).")
                console.log(err)
            }
        })
    })

    GetUserKeywords()
})
</script>

</html>