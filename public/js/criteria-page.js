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
            keyword.classList.add("keyword");
            keyword.id = "keyword_" + obj.id;
            keyword.innerText = obj.keyword;
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

const AddKeyword = async () => {
    let keywordInput = document.getElementById("keyword-input");

    try {
        const {
            data: response
        } = await axios.post(`${baseURL}/api/user-keywords`, {
            userID: userID,
            keyword: keywordInput.value
        })
        console.log(response)
        const $keywordsList = document.getElementById("keywords-list");
        const keyword = document.createElement("li");
        keyword.classList.add("keyword");
        keyword.id = "keyword_" + response[0].id;
        keyword.innerText = response[0].keyword;
        $keywordsList.append(keyword);
        keywordInput.value = "";
    } catch (err) {
        alert(
            `An error occurred. HTTP status: ${err.status}. Error reads: ${err.statusText}`
        );
        console.log(err);
    }
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

    document.addEventListener("click", function (e) {
        let target = e.target;
        if (target.classList.contains("keyword")) {
            let id = target.id.split("_")[1];
            if (!selectedKeywords.includes(id)) {
                selectedKeywords.push(id);
                target.classList.add("keyword--selected");
            } else {
                selectedKeywords.splice(selectedKeywords.indexOf(id), 1);
                target.classList.remove("keyword--selected");
            }
            // Display delete btn if keywords are selected
            let btnDelKeywords = document.getElementById("btn-del-keywords");
            let selectedCount = document.getElementById("selected-count");
            selectedKeywords.length > 0 ? btnDelKeywords.style.visibility = "visible" : btnDelKeywords.style.visibility = "hidden";
            // Update the selected count to display in the delete button's text
            selectedCount.innerText = selectedKeywords.length;
        }
    })

    GetUserKeywords();
    GetUserThreshold();
});
