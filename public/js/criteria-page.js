const GetUserKeywords = async () => {
    const $loadingIndicatorNodeList = document.querySelectorAll(".lds-dual-ring, .loading-overlay");
    for (let node of $loadingIndicatorNodeList) {
        node.style.display = "block"
    }

    try {
        const {
            data: keywords
        } = await axios.get(`${baseURL}/api/user-keywords`, {
            params: {
                userID: userID
            }
        });
        for (let node of $loadingIndicatorNodeList) {
            node.style.display = "none";
        }
        if (!keywords.length) {
            document.querySelector(".no-keywords").style.display = "block";
        }

        const $keywordsList = document.getElementById("keywords-list");
        while ($keywordsList.firstChild) {
            $keywordsList.removeChild($keywordsList.lastChild);
        }

        keywords.forEach(obj => {
            const keyword = document.createElement("li");
            keyword.classList.add("keyword")
            keyword.id = "keyword_" + obj.id;
            keyword.innerText = obj.keyword;

            keyword.addEventListener("click", function (e) {
                let id = this.id.split("_")[1];
                if (!selectedKeywords.includes(id)) {
                    selectedKeywords.push(id);
                    this.classList.add("keyword--selected");
                } else {
                    selectedKeywords.splice(selectedKeywords.indexOf(id), 1);
                    this.classList.remove("keyword--selected");
                }
            })

            // Display delete btn if keywords are selected
            let btnDelKeywords = document.getElementById("btn-del-keywords");
            selectedKeywords.length > 0 ? btnDelKeywords.style.visibility = "visible" : btnDelKeywords.style.visibility = "hidden";
            // Update the selected count to display in the delete button's text
            document.getElementById("selected-count").innerText = selectedKeywords.length;

            $keywordsList.append(keyword);
        })

    } catch (err) {
        for (let node of $loadingIndicatorNodeList) {
            node.style.display = "none";
        }
        alert(
            `An error occurred. HTTP status: ${err.status}. Error reads: ${err.statusText}`
        );
        console.log(err);
    }
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
            console.log(res);
            location.reload();
        })
        .catch(err => {
            alert("Error occurred when trying to add keyword.");
            console.log(err);
        });
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
                $("#threshold-input").val(res[0].comment_threshold.toString());
            }
        })
        .catch(err => {
            alert(
                `An error occurred. HTTP status: ${err.status}. Error reads: ${err.statusText}`
            );
            console.log(err);
        });
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
            location.reload();
        })
        .catch(err => {
            alert(
                `An error occurred. HTTP status: ${err.status}. Error reads: ${err.statusText}`
            );
            console.log(err);
        });
}

// List of keywords the user has selected (for deleting keywords)
const selectedKeywords = [];

$(document).ready(function () {
    const path = window.location.pathname;

    $("#btn-add-keyword").on("click", function (e) {
        AddKeyword();
    });

    $("#keyword-input").on("keypress", function (e) {
        if (e.which === 13 && $(this).val() !== "") {
            AddKeyword();
        }
    });

    $("#btn-del-keywords").on("click", function (e) {
        $.ajax({
                url: `${baseURL}/api/user-keywords`,
                method: "DELETE",
                data: {
                    keywordIDList: selectedKeywords
                }
            })
            .then(res => {
                console.log(res);
                location.reload();
            })
            .catch(err => {
                alert(
                    `An error occurred. HTTP status: ${err.status}. Error reads: ${err.statusText}`
                );
                console.log(err);
            });
    });

    $("#btn-set-threshold").on("click", function (e) {
        SetUserThreshold();
    });

    $("#threshold-input").on("keypress", function (e) {
        if (e.which === 13) {
            SetUserThreshold();
        }
    });

    GetUserKeywords();
    GetUserThreshold();
});
