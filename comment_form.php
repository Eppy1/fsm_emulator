<style>
    .comment {
        border: none;
    }

    .comment td {
        border: none;
        text-align: left;
        padding-top: 8px;
        padding-bottom: 16px;
    }

    .comment tr {
        border:none;
    }

    .ava {
        max-width: 48px;
        max-height: 48px;
        border: 1px solid #fff;
        background-color: #fff;
        box-shadow: 0 0 9px rgba(0,0,0,0.3);
        border-radius: 1mm;
    }

    #table_comment {
        border-collapse: collapse;
        width: 60%;
    }

    #table_comment tr {
        border-bottom: 1px solid #eee;
        border-top: 1px solid #eee;
        border-collapse: collapse;
        text-align: left;

        -webkit-transition: all 0.25s ease;;
        -moz-transition: all 0.25s ease;;
        -o-transition: all 0.25s ease;;
        transition: all 0.25s ease;
    }

    #table_comment tr:hover {
        background: #ece1f1;
    }

    .nickname {
        font-size: large;
        font-weight: bold;
    }

    .expr {
        font-size: large;
    }

    .time {
        font-weight: normal;
        font-size: small;
        color: #777;
    }

    textarea {
    }

    #ava_td {
        max-width: 60px;
    }

    textarea {
        height: 72px;
        width: 60%;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-size: large;
        color: #333;
        border: 1px solid #777;
        padding: 5px;
        border-radius: 2px;
        -webkit-border-radius: 1mm;
        -moz-border-radius: 1mm;
        border-radius: 1mm;
        resize: none;
    }

    #comment_counter {
        text-align: left;
        width: 60%;
        color: #777;
    }

</style>

</span id="comment_form">
    <div id="comment_counter">n comments</div>
    <table id="table_comment">
    </table>

    <h3> Write a comment:<h3>
    <textarea id='new_comment_field' placeholder='Type your new comment here...'></textarea><br>
    <button class="button" style='margin-left:0px;'onclick='cmt_comment()' id='btn_comment'>Comment!</button>
    <script src="comment.js"></script>
<span>