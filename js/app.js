$(function() {

    var splash = new Vue({
        el: "#intro",
        data: {
            showHeader: false
        }
    });

    var search = new Vue({
        el: "#app",
        data: {
            page: 1, // 1 - Search Results; 2 - Branch Page
            shown: 10,
            searchNum: 0,
            bankQry: "",
            searchRes: [],
            selectedBranch: {},
            newComment: "",
            comments: [],
            complaints: [],
        },
        computed: {
            shownBranches() {
                return this.searchRes.slice(0, this.shown);
            }
        },
        methods: {
            search: function() {
                var keywords = this.bankQry;
                this.shown = 10;
                var results = [];
                $.ajax({
                    type: "POST",
                    url: "util/search.php",
                    dataType: "json",
                    data: {
                        keys: keywords
                    },
                    success: function(res) {
                        search.searchRes = [];
                        search.searchRes.pop();
                        res.forEach(function(bank) {
                            search.searchRes.push(bank)
                        });
                    },
                    error: function(req, stat, err) {
                        // Just in case
                    }
                });
                this.searchNum++;
                this.page = 1;
            },
            loadBranch: function(branch) {
                var keywords = this.bankQry;
                this.selectedBranch = branch;
                this.complaints = [];
                this.comments = [];

                $.ajax({
                    url: "util/comment.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        branchId: branch.bId,
                        action: 0
                    },
                    success: function(res) {
                        res.forEach(function(comment) {
                            search.comments.push(comment);
                        });
                    }
                });

                $.ajax({
                    url: "https://data.consumerfinance.gov/resource/jhzv-w97w.json",
                    type: "GET",
                    data: {
                        "$limit": 10,
                        "$q": branch.name,
                        "zip_code": branch.zip.slice(0, -2) + 'XX',
                        "$where": "complaint_what_happened IS NOT NULL"
                    },
                    success: function(res) {
                        res.forEach(function(complaint) {
                            search.complaints.push(complaint);
                        });
                    }
                });

                this.page = 2;
            },
            addComment: function() {
                var com = this.newComment;
                var branch = this.selectedBranch;

                $.ajax({
                    url: "util/comment.php",
                    type: "POST",
                    data: {
                        branchId: branch.bId,
                        comment: com,
                        action: 1
                    },
                    success: function(res) {
                        search.comments.push({user: "You wrote just now", body: com});
                        search.newComment = "";
                    }
                });
            }
        }
    });

});
