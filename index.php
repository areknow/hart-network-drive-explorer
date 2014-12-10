<div class="wrapper isnotes">
    <form action="#" method="post">
        <input id="txt-search" type="text" name="searcher">
        <button id="btn-search" name="submitter"><i class="fa fa-search"></i></button>
    </form>
    
    <div class="spacer"></div>
    <div class="results">
    <?PHP

    # filtering function
    function filterArray($array) {
        
        # initialize a new array for storage
        $newarray = array();

        # loop through compare with stripos
        foreach ($array as $item) {
            $pos = stripos($item, $GLOBALS['search']);
            if ($pos !== false) {
                
                # add to new array
                $newarray[] = $item;
            }
        }
        return $newarray;
    }

    # load directory, parse into array, check file type, print hrefs
    function returnDocs($isfiltered) {

        # load path
        $path = '\\\\hmfile01\\notes\\is notes';
        
        # initialize the counter
        $resultcount = 0;

        # initialize paths array
        $path_stack = array();

        # build iterator of objects from path
        $directory_objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));

        # convert RecursiveIteratorIterator into flat array
        foreach($directory_objects as $fullpath => $directory_objects) {
            $path_stack[] = $fullpath;
        }

        # if filtered, call filter function
        if ($isfiltered == "true") {
            $path_stack = filterArray($path_stack);
        }
        
        # alphabetize output
        ksort($path_stack);
        
        # loop through stack and create hrefs
        foreach ($path_stack as $path) {

            # extract filename and extension
            $extension = pathinfo($path, PATHINFO_EXTENSION); 
            $filename = pathinfo($path, PATHINFO_FILENAME); 
            $filesize = filesize($path);
            $displayname = "$filename.$extension";

            # remove unwanted file types and directory markers
            if ($extension == "pdf"  || 
                $extension == "rtf"  || 
                $extension == "txt"  || 
                $extension == "docx" || 
                $extension == "doc"  || 
                $extension == "xls"  || 
                $extension == "xlsx" || 
                $extension == "jpg"  || 
                $extension == "bmp"  || 
                $extension == "png") {
                
                # increment counter
                $resultcount ++;

                # print links to objects using the file handler script to build hrefs
                echo "<a target='_blank' href='../php/filehandler.php?name=$path&ext=$extension&shortname=$displayname&size=$filesize'>$displayname</a>";
            }   
        }

        # print the result count div
        if ($isfiltered == "true") {
            echo "<div class='search-counter'>$resultcount results for <strong>'".$GLOBALS['search']."'</strong></div>";
        }
        else {
            echo "<div class='search-counter'>Enter search terms or browse the $resultcount items in <strong>'N:\IS Notes'</strong></div>";
        }
        
    }

    # on-button-click functions
    if(isset($_POST['submitter'])) {

        # post the search string from html
        $searchterm = $_POST['searcher'];

        # save search term to global array for filter
        $GLOBALS['search'] = $searchterm;

        # empty search box function
        if (!($searchterm)) {
            returnDocs("false");
        } 

        # not empty search box function
        else {
            returnDocs("true");
        }
    }
    else {
        returnDocs("false");
    }
    ?>       
    </div>
</div>
