<body>
<div id="content">
    <div id="main">
        <div class="privacyNotice">
            <h1>Privacy notice</h1>
            <p>Do you agree to answer questions about your quality of life in the nursing home?</p>

            <p>The information given will be processed anonymously.</p>
        </div>
        <div id="button">
            <button class="button2Clicked" onclick="location.href='<? echo base_url(); ?>ResidentController/resident/ifSurveyNotEnded'">I agree</button>
        </div>
    </div>
</div>
</body>
</html>
<script>
    function goBack() {
        window.location.href = base_url + "ResidentController/resident/privacy";
    }
</script>