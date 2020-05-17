(function () {
    // List of keywords the user has selected (for deleting keywords)
    let selectedKeywords = [];

    const GetUserKeywords = async () => {
        const $loadingIndicatorNodeList = document.querySelectorAll(".lds-dual-ring, .loading-overlay");
        for (let node of $loadingIndicatorNodeList) {
            node.style.display = "block"
        }
        try {
            const {
                data: res
            } = await axios.get(`${baseURL}/api/user-keywords`, {
                params: {
                    userID: userID
                }
            });
            for (let node of $loadingIndicatorNodeList) {
                node.style.display = "none";
            }
            if (!res.length) {
                document.querySelector(".no-keywords").style.display = "block";
            }

            const $keywordsList = document.getElementById("keywords-list");
            while ($keywordsList.firstChild) {
                $keywordsList.removeChild($keywordsList.lastChild);
            }

            res.forEach(obj => {
                const $keyword = document.createElement("li");
                $keyword.classList.add("keyword");
                $keyword.id = "keyword_" + obj.id;
                $keyword.innerText = obj.keyword;
                $keywordsList.append($keyword);
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
        let $keywordInput = document.getElementById("keyword-input");

        try {
            const {
                data: response
            } = await axios.post(`${baseURL}/api/user-keywords`, {
                userID: userID,
                keyword: $keywordInput.value
            })

            const $keywordsList = document.getElementById("keywords-list");
            const $keyword = document.createElement("li");
            $keyword.classList.add("keyword");
            $keyword.id = "keyword_" + response[0].id;
            $keyword.innerText = response[0].keyword;
            $keywordsList.append($keyword);
            $keywordInput.value = "";
        } catch (err) {
            alert(
                `An error occurred. HTTP status: ${err.status}. Error reads: ${err.statusText}`
            );
            console.log(err);
        }
    }

    const DeleteKeywords = async () => {
        let $btnDelKeywords = document.getElementById("btn-del-keywords");

        try {
            const {
                data: res
            } = await axios.delete(`${baseURL}/api/user-keywords`, {
                data: {
                    keywordIDList: selectedKeywords
                }
            })
            for (const id of selectedKeywords) {
                document.getElementById(`keyword_${id}`).remove();
            }
            selectedKeywords = [];
            $btnDelKeywords.style.visibility = "hidden";
        } catch (err) {
            $btnDelKeywords.style.visibility = "hidden";
            alert(
                `An error occurred. HTTP status: ${err.status}. Error reads: ${err.statusText}`
            );
            console.log(err);
        }
    }

    const GetUserThreshold = async () => {
        const $thresholdInput = document.getElementById("threshold-input");

        try {
            const {
                data: res
            } = await axios.get(`${baseURL}/api/user-threshold`, {
                params: {
                    userID: userID
                }
            })
            if (res.length > 0) {
                $thresholdInput.value = res[0].comment_threshold.toString();
            }
        } catch (err) {
            alert(
                `An error occurred. HTTP status: ${err.status}. Error reads: ${err.statusText}`
            );
            console.log(err);
        }
    }

    const SetUserThreshold = async () => {
        const $thresholdInput = document.getElementById("threshold-input");
        try {
            const {
                data: res
            } = await axios.post(`${baseURL}/api/user-threshold`, {
                userID: userID,
                threshold: parseInt($thresholdInput.value)
            })
            $thresholdInput.value = parseInt(res[0].comment_threshold);
            alert("Threshold updated successfully.");
        } catch (err) {
            alert(
                `An error occurred. HTTP status: ${err.status}. Error reads: ${err.statusText}`
            );
            console.log(err);
        }
    }


    document.addEventListener("keydown", e => {
        let target = e.target;
        if (e.key === "Enter") {
            if (target.id === "keyword-input") {
                if (target.value !== "") AddKeyword();
            }
            if (target.id === "threshold-input") SetUserThreshold();
        }
    })

    document.addEventListener("click", function (e) {
        let target = e.target;
        if (target.id === "btn-add-keyword") AddKeyword();
        if (target.id === "btn-set-threshold") SetUserThreshold();
        if (target.id === "btn-del-keywords") DeleteKeywords();

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
            let $btnDelKeywords = document.getElementById("btn-del-keywords");
            let selectedCount = document.getElementById("selected-count");
            selectedKeywords.length > 0 ? $btnDelKeywords.style.visibility = "visible" : $btnDelKeywords.style.visibility = "hidden";
            // Update the selected count to display in the delete button's text
            selectedCount.innerText = selectedKeywords.length;
        }
    })

    GetUserKeywords();
    GetUserThreshold();
}())
