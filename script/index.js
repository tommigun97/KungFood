$(function () {
  $('#grid_table').jsGrid({

    width: "100%",
    height: "600px",

    filtering: true,
    inserting: true,
    editing: true,
    sorting: true,
    paging: true,
    autoload: true,
    pageSize: 10,
    pageButtonCount: 5,
    deleteConfirm: "Do you really want to delete data?",

    controller: {
      loadData: function (filter) {
        return $.ajax({
          type: "GET",
          url: "fetch_data.php",
          data: filter
        });
      },
      insertItem: function (item) {
        return $.ajax({
          type: "POST",
          url: "fetch_data.php",
          data: item
        });
      },
      updateItem: function (item) {
        return $.ajax({
          type: "PUT",
          url: "fetch_data.php",
          data: item
        });
      },
      deleteItem: function (item) {
        return $.ajax({
          type: "DELETE",
          url: "fetch_data.php",
          data: item
        });
      },
    },

    fields: [
      {
        name: "id",
        type: "text",
        width: 40
      },
      {
        name: "nome",
        type: "text",
        width: 50,
        validate: "required"
      },
      {
        name: "costo",
        type: "number",  // da fare la conversione
        width: 50,
        validate: "required"
      },
      {
        name: "presente",
        type: "select",
        width: 50,
        items: [
          { Name: "", Id: '' },
          { Name: "Yes", Id: 's' },
          { Name: "No", Id: 'n' }
        ],
        valueField: "Id",
        textField: "Name",
        validate: "required"
      },
      {
        name: "descrizione",
        type: "text",
        width: 120
        
      },
      {
        name: "urlfoto",
        type: "text",
        width: 70
        
      },{
        name: "idfornitore",
        type: "text",  
                //css: 'hide'   
        width: 40   
      },
      {
        type: "control"
      }
    ]

  });
});