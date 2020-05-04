function GetUserKeywords() {
    $(".lds-dual-ring, .loading-overlay").show()

    $.ajax({
        url: `${baseURL}/api/user-keywords`,
        method: "GET",
        dataType: "json",
        data: {
            userID: userID
        },
        success: function (res) {
            $(".lds-dual-ring, .loading-overlay").hide()
            if (!res.length) {
                $(".no-keywords").show()
            }

            var keywordsList = $("#keywords-list")
            keywordsList.empty()

            res.forEach(function (obj, index) {
                var keyword = $("<li>").addClass("keyword").attr("id", "keyword_" + obj.id).data("keyword_id", obj.id).text(obj.keyword)

                keyword.on("click", function (e) {
                    if (!selectedKeywords.includes($(this).data("keyword_id"))) {
                        selectedKeywords.push($(this).data("keyword_id"))
                        $(this).addClass("keyword--selected")
                    } else {
                        selectedKeywords.splice(selectedKeywords.indexOf($(this).data("keyword_id")), 1)
                        $(this).removeClass("keyword--selected")
                    }
                    // Display delete btn if keywords are selected
                    selectedKeywords.length ? $("#btn-del-keywords").css("visibility", "visible") : $("#btn-del-keywords").css("visibility", "hidden")
                    // Update the selected count to display in the delete button's text
                    $("#selected-count").text(selectedKeywords.length)
                })
                keywordsList.append(keyword)
            })
        },
        error: function (err) {
            $(".lds-dual-ring, .loading-overlay").hide()
            alert(`An error occurred. HTTP status: ${err.status}. Error reads: ${err.statusText}`)
            console.log(err)
        }
    })
}

function AddKeyword() {
    $.ajax({
        url: `${baseURL}/api/user-keywords`,
        method: "POST",
        data: {
            userID: userID,
            keyword: $("#keyword-input").val()
        },
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

function GetUserThreshold() {
    $.ajax({
        url: `${baseURL}/api/user-threshold`,
        method: "GET",
        dataType: "json",
        data: {
            userID: userID
        },
        success: function (res) {
            if (res.length > 0) {
                $("#threshold-input").val(res[0].comment_threshold.toString())
            }
        },
        error: function (err) {
            alert(`An error occurred. HTTP status: ${err.status}. Error reads: ${err.statusText}`)
            console.log(err)
        }
    })
}

function SetUserThreshold() {
    $.ajax({
        url: `${baseURL}/api/user-threshold`,
        method: "POST",
        data: {
            userID: userID,
            threshold: parseInt($("#threshold-input").val())
        },
        success: function (res) {
            location.reload()
        },
        error: function (err) {
            alert(`An error occurred. HTTP status: ${err.status}. Error reads: ${err.statusText}`)
            console.log(err)
        }
    })
}

// List of keywords the user has selected (for deleting keywords)
var selectedKeywords = []

$(document).ready(function () {

    $("#btn-add-keyword").on("click", function (e) {
        AddKeyword();
    })

    $("#keyword-input").on("keypress", function (e) {
        if (e.which === 13 && $(this).val() !== "") {
            AddKeyword();
        }
    })

    $("#btn-del-keywords").on("click", function (e) {
        $.ajax({
            url: `${baseURL}/api/user-keywords`,
            method: "DELETE",
            data: {
                keywordIDList: selectedKeywords
            },
            success: function (res) {
                console.log(res)
                location.reload()
            },
            error: function (err) {
                alert(`An error occurred. HTTP status: ${err.status}. Error reads: ${err.statusText}`)
                console.log(err)
            }
        })
    })

    $("#btn-set-threshold").on("click", function (e) {
        SetUserThreshold()
    })

    $("#threshold-input").on("keypress", function (e) {
        if (e.which === 13) {
            SetUserThreshold()
        }
    })

    GetUserKeywords()
    GetUserThreshold()
})
