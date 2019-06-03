<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Select2</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/prettify.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
          $('.js-example-basic-single').select2();
          $('.js-example-basic-multiple').select2();

          $('.js-data-example-ajax').select2({
            ajax: {
              url: 'search.php',
              dataType: 'json'
              // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
            }
          });
         /*
          $('.js-data-example-ajax').select2({
            tags: true,
            multiple: true,
            tokenSeparators: [',', ' '],
            minimumInputLength: 2,
            minimumResultsForSearch: 10,
            ajax: {
                url: 'search.php',
                dataType: "json",
                type: "GET",
                data: function (params) {

                    var queryParameters = {
                        term: params.term
                    }
                    return queryParameters;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.tag_value,
                                id: item.tag_id
                            }
                        })
                    };
                }
            }
        });
        */
      });
    </script>
</head>
<body>
 
<select class="js-example-basic-single form-control">
    <?php include("options.php"); ?>
</select>

<br><br>

<select class="js-example-basic-multiple" name="states[]" multiple="multiple">
    <?php include("options.php"); ?>
</select>

<br><br>

<select class="js-data-example-ajax"></select>




</body>
</html>