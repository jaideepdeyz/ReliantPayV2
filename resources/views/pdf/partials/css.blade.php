<style media="screen">
.row > * {
  flex-shrink: 0;
  width: 100%;
  max-width: 100%;
  padding-right: calc(var(--bs-gutter-x) * 0.5);
  padding-left: calc(var(--bs-gutter-x) * 0.5);
  margin-top: var(--bs-gutter-y);
}
@page {
    margin-top: 70px; /* create space for header */
    margin-bottom: 100px; /* create space for footer */
}

#watermark {
  position: fixed;
  text-align: center;
  height:100%;
  /* top: 4cm; */
  z-index:  -1000;
  padding: 0px;
}

footer {
    position: fixed; 
    bottom: -60px; 
    left: 0px; 
    right: 0px;
    height: 90px; 

    /** Extra personal styles **/
    /* background-color: #830303; */
    color: rgb(170, 12, 12);
    text-align: center;
    line-height: 10px;
}

.col {
  flex: 1 0 0%;
}
.row-cols-auto > * {
  flex: 0 0 auto;
  width: 100%;
}
.row-cols-1 > * {
  flex: 0 0 auto;
  width: 100%;
}
.row-cols-2 > * {
  flex: 0 0 auto;
  width: 50%;
}
.row-cols-3 > * {
  flex: 0 0 auto;
  width: 33.3333333333%;
}
.row-cols-4 > * {
  flex: 0 0 auto;
  width: 25%;
}
.row-cols-5 > * {
  flex: 0 0 auto;
  width: 20%;
}
.row-cols-6 > * {
  flex: 0 0 auto;
  width: 16.6666666667%;
}
.col-auto {
  flex: 0 0 auto;
  width: auto;
}
.col-1 {
  flex: 0 0 auto;
  width: 8.33333333%;
}
.col-2 {
  flex: 0 0 auto;
  width: 16.66666667%;
}
.col-3 {
  flex: 0 0 auto;
  width: 25%;
}
.col-4 {
  flex: 0 0 auto;
  width: 33.33333333%;
}
.col-5 {
  flex: 0 0 auto;
  width: 41.66666667%;
}
.col-6 {
  flex: 0 0 auto;
  width: 50%;
}
.col-7 {
  flex: 0 0 auto;
  width: 58.33333333%;
}
.col-8 {
  flex: 0 0 auto;
  width: 66.66666667%;
}
.col-9 {
  flex: 0 0 auto;
  width: 75%;
}
.col-10 {
  flex: 0 0 auto;
  width: 83.33333333%;
}
.col-11 {
  flex: 0 0 auto;
  width: 91.66666667%;
}
.col-12 {
  flex: 0 0 auto;
  width: 100%;
}
.col-md-12 {
    flex: 0 0 auto;
    width: 100%;
  }
.col-md-6 {
  flex: 0 0 auto;
  width: 50%;
}
.alert {
    position: relative;
    padding: 0.75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: 0.25rem;
  }
.table {
    width: 100%;
    /* margin-bottom: 1rem; */
    color: #212529;
    border-collapse: collapse;
    /* border: 1px solid black; */
  }

  .table th,
  .table td {
    padding: 0.40rem;
    vertical-align: top;
    border: 1px solid black;
  }
  

  .table thead th {
    vertical-align: bottom;
    border: 1px solid black;
  }

  .table tbody + tbody {
    /* border: 1px solid black; */
  }

  .table-sm th,
  .table-sm td {
    /* padding: 0.3rem; */
  }

  .table-bordered {
    border: 1px solid #dee2e6;
  }

  .table-bordered th,
  .table-bordered td {
    border: 1px solid #dee2e6;
  }

  .table-bordered thead th,
  .table-bordered thead td {
    /* border-bottom-width: 2px; */
  }

  .table-borderless th,
  .table-borderless td,
  .table-borderless thead th,
  .table-borderless tbody + tbody {
    border: 0;
  }

  .table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.05);
  }

  .table-hover tbody tr:hover {
    color: #212529;
    background-color: rgba(0, 0, 0, 0.075);
  }

  .table-primary,
  .table-primary > th,
  .table-primary > td {
    background-color: #b8daff;
  }

  .table-primary th,
  .table-primary td,
  .table-primary thead th,
  .table-primary tbody + tbody {
    border-color: #7abaff;
  }

  .table-hover .table-primary:hover {
    background-color: #9fcdff;
  }

  .table-hover .table-primary:hover > td,
  .table-hover .table-primary:hover > th {
    background-color: #9fcdff;
  }

  .table-secondary,
  .table-secondary > th,
  .table-secondary > td {
    background-color: #d6d8db;
  }

  .table-secondary th,
  .table-secondary td,
  .table-secondary thead th,
  .table-secondary tbody + tbody {
    border-color: #b3b7bb;
  }

  .table-hover .table-secondary:hover {
    background-color: #c8cbcf;
  }

  .table-hover .table-secondary:hover > td,
  .table-hover .table-secondary:hover > th {
    background-color: #c8cbcf;
  }

  .table-success,
  .table-success > th,
  .table-success > td {
    background-color: #c3e6cb;
  }

  .table-success th,
  .table-success td,
  .table-success thead th,
  .table-success tbody + tbody {
    border-color: #8fd19e;
  }

  .table-hover .table-success:hover {
    background-color: #b1dfbb;
  }

  .table-hover .table-success:hover > td,
  .table-hover .table-success:hover > th {
    background-color: #b1dfbb;
  }

  .table-info,
  .table-info > th,
  .table-info > td {
    background-color: #bee5eb;
  }

  .table-info th,
  .table-info td,
  .table-info thead th,
  .table-info tbody + tbody {
    border-color: #86cfda;
  }

  .table-hover .table-info:hover {
    background-color: #abdde5;
  }

  .table-hover .table-info:hover > td,
  .table-hover .table-info:hover > th {
    background-color: #abdde5;
  }

  .table-warning,
  .table-warning > th,
  .table-warning > td {
    background-color: #ffeeba;
  }

  .table-warning th,
  .table-warning td,
  .table-warning thead th,
  .table-warning tbody + tbody {
    border-color: #ffdf7e;
  }

  .table-hover .table-warning:hover {
    background-color: #ffe8a1;
  }

  .table-hover .table-warning:hover > td,
  .table-hover .table-warning:hover > th {
    background-color: #ffe8a1;
  }

  .table-danger,
  .table-danger > th,
  .table-danger > td {
    background-color: #f5c6cb;
  }

  .table-danger th,
  .table-danger td,
  .table-danger thead th,
  .table-danger tbody + tbody {
    border-color: #ed969e;
  }

  .table-hover .table-danger:hover {
    background-color: #f1b0b7;
  }

  .table-hover .table-danger:hover > td,
  .table-hover .table-danger:hover > th {
    background-color: #f1b0b7;
  }

  .table-light,
  .table-light > th,
  .table-light > td {
    background-color: #fdfdfe;
  }

  .table-light th,
  .table-light td,
  .table-light thead th,
  .table-light tbody + tbody {
    border-color: #fbfcfc;
  }

  .table-hover .table-light:hover {
    background-color: #ececf6;
  }

  .table-hover .table-light:hover > td,
  .table-hover .table-light:hover > th {
    background-color: #ececf6;
  }

  .table-dark,
  .table-dark > th,
  .table-dark > td {
    background-color: #c6c8ca;
  }

  .table-dark th,
  .table-dark td,
  .table-dark thead th,
  .table-dark tbody + tbody {
    border-color: #95999c;
  }

  .table-hover .table-dark:hover {
    background-color: #b9bbbe;
  }

  .table-hover .table-dark:hover > td,
  .table-hover .table-dark:hover > th {
    background-color: #b9bbbe;
  }

  .table-active,
  .table-active > th,
  .table-active > td {
    background-color: rgba(0, 0, 0, 0.075);
  }

  .table-hover .table-active:hover {
    background-color: rgba(0, 0, 0, 0.075);
  }

  .table-hover .table-active:hover > td,
  .table-hover .table-active:hover > th {
    background-color: rgba(0, 0, 0, 0.075);
  }

  .table .thead-dark th {
    color: #fff;
    background-color: #343a40;
    border-color: #454d55;
  }

  .table .thead-light th {
    color: #495057;
    background-color: #e9ecef;
    border-color: #dee2e6;
  }

  .table-dark {
    color: #fff;
    background-color: #343a40;
  }

  .table-dark th,
  .table-dark td,
  .table-dark thead th {
    border-color: #454d55;
  }

  .table-dark.table-bordered {
    border: 0;
  }

  .table-dark.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(255, 255, 255, 0.05);
  }

  .table-dark.table-hover tbody tr:hover {
    color: #fff;
    background-color: rgba(255, 255, 255, 0.075);
  }
  .text-center {
  text-align: center !important;
  }

*{font-family: sans-serif,}
  p{font-size:12px}
  h5{font-size:16px;font-weight:bold}
  tr td th{font-size:12px;}
  ol,ul {padding-left: 2rem;}
  ol,ul,dl {margin-top: 0;margin-bottom: 1rem;}
  ol ol,ul ul,ol ul,ul ol {margin-bottom: 0;}
  sub, sup {position: relative;font-size: 0.75em;line-height: 0;vertical-align: baseline;}
  sup {top: -0.5em;}

</style>
