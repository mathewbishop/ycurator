function GetUserKeywords() {
    $(".lds-dual-ring, .loading-overlay").show()

    $.ajax({
            url: `${baseURL}/api/user-keywords`,
            method: "GET",
            dataType: "json",
            data: {
                userID: userID
            }
        })
        .then(res => {
            $(".lds-dual-ring, .loading-overlay").hide()
            if (!res.length) {
                $(".no-keywords").show()
            }

            const keywordsList = $("#keywords-list")
            keywordsList.empty()

            res.forEach((obj, index) => {
                const keyword = $("<li>").addClass("keyword").attr("id", "keyword_" + obj.id).data("keyword_id", obj.id).text(obj.keyword)

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
        })
        .catch(err => {
            $(".lds-dual-ring, .loading-overlay").hide()
            alert(`An error occurred. HTTP status: ${err.status}. Error reads: ${err.statusText}`)
            console.log(err)
        })

}

function AddKeyword() {
    $.ajax({
            url: `${baseURL}/api/user-keywords`,
            method: "POST",
            data: {
                userID: userID,
                keyword: $("#keyword-input").val()
            }
        })
        .then(res => {
            console.log(res)
            location.reload()
        })
        .catch(err => {
            alert("Error occurred when trying to add keyword.")
            console.log(err)
        })
}

function GetUserThreshold() {
    $.ajax({
            url: `${baseURL}/api/user-threshold`,
            method: "GET",
            dataType: "json",
            data: {
                userID: userID
            }
        })
        .then(res => {
            if (res.length > 0) {
                $("#threshold-input").val(res[0].comment_threshold.toString())
            }
        })
        .catch(err => {
            alert(`An error occurred. HTTP status: ${err.status}. Error reads: ${err.statusText}`)
            console.log(err)
        })
}

function SetUserThreshold() {
    $.ajax({
            url: `${baseURL}/api/user-threshold`,
            method: "POST",
            data: {
                userID: userID,
                threshold: parseInt($("#threshold-input").val())
            }
        })
        .then(res => {
            location.reload()
        })
        .catch(err => {
            alert(`An error occurred. HTTP status: ${err.status}. Error reads: ${err.statusText}`)
            console.log(err)
        })
}

// List of keywords the user has selected (for deleting keywords)
const selectedKeywords = []

$(document).ready(function () {
    const path = window.location.pathname

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
                }
            })
            .then(res => {
                console.log(res)
                location.reload()
            })
            .catch(err => {
                alert(`An error occurred. HTTP status: ${err.status}. Error reads: ${err.statusText}`)
                console.log(err)
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
