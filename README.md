CsvMapper
=========

#### PHP Class for mapping Csv files in array mapping csv for lazy people


You can(for now):

- getBy($nomeHeader, $cerca) - Find the rows that contain $cerca in column $nomeHeader
- getHeader() - Return the list of the header
- selDistinctHead($nomeHeader) - Select only the different rows
- sortBy($header, $type) - Sort the csv by the $header, in order $type("ASC" || "DESC")

