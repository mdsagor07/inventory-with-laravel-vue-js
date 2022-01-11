class Notification{

    success(){

        new Noty({
           type:"success",
           layout:"topRight",
           text: 'successfully done',
           timeout:1000,
           
        }).show();
    }

    alreadypaid(){

        new Noty({
           type:"alert",
           layout:"topRight",
           text: 'already paid',
           timeout:1000,
           
        }).show();
    }

    alert(){

        new Noty({
           type:"alert",
           layout:"topRight",
           text: 'are you sure?',
           timeout:1000,
           
        }).show();
    }

    error(){

        new Noty({
           type:"alert",
           layout:"topRight",
           text: 'something is wrong',
           timeout:1000,
           
        }).show();
    }
    warning(){

        new Noty({
           type:"warning",
           layout:"topRight",
           text: 'opps! wrong ',
           timeout:1000,
           
        }).show();
    }
    image_validate(){

        new Noty({
           type:"warning",
           layout:"topRight",
           text: 'please upload image less than 1 MB ',
           timeout:1000,
           
        }).show();
    }
  


}

export default Notification = new Notification();