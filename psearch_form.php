<style>
    #table_psearch {
        border-collapse: collapse;
    }

    .program_name {
        font-weight: bold;
        font-size: larger;
    }

    .program_type {
        font-weight: normal;
        font-size: small;
        color: #777;
    }

    .stars {
        font-weight: bold;
        /*font-size: x-large;*/
    }

    .time_ref {
        font-weight: normal;
        color: #777;
    }

    #table_psearch td {
        border: none;
        vertical-align: top;
        padding-top: 12px;
        padding-bottom: 24px;
        padding-left: 8px;
        padding-right: 8px;
    }

    #table_psearch tr {
        border-bottom: 1px solid #bbb;
        border-top: 1px solid #bbb;
        border-collapse: collapse;
    }

    #table_psearch tr:hover {
        background: #fec;
    }

    #input {
        border: none;
        border-bottom: 2px solid #777;
        margin-bottom: 15px;
        font-size: large;
    }

</style>

<script src="psearch.js"></script>

<input id="input" oninput="psearch_filter()" type="text" placeholder="Название программы...">

<table id="table_psearch">
</table>