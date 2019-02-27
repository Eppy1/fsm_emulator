<style>
    #table_psearch {
        border-collapse: collapse;
        width: 640px;
    }

    .program_name {
        font-weight: bold;
        font-size: large;
    }

    .program_type {
        font-weight: normal;
        font-size: small;
        color: #777;
    }

    .stars {
        font-weight: bold;
        vertical-align: bottom;
    }

    .time_ref {
        font-weight: normal;
        color: #777;
    }

    #table_psearch td {
        border: none;
        vertical-align: middle;
        padding: 18px;
    }

    #table_psearch tr {
        border-bottom: 1px solid #bbb;
        border-top: 1px solid #bbb;
        border-collapse: collapse;

        -webkit-transition: all 0.25s ease;;
        -moz-transition: all 0.25s ease;;
        -o-transition: all 0.25s ease;;
        transition: all 0.25s ease;
    }

    #table_psearch tr:hover {
        background: #ece1f1;
    }

    #input {
        border: none;
        border-bottom: 2px solid #777;
        margin-bottom: 15px;
        font-size: large;
    }

    ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
        font-family: Arial, Helvetica, sans-serif;
        font-size: small;
    }
</style>

<script src="psearch.js"></script>

<input id="input" oninput="psearch_filter()" type="text" placeholder="Search...">

<table id="table_psearch">
</table>