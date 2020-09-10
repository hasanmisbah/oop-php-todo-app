$(function () {

    let createTodo = $('.new-todo');
    let clearComplete = $('.clear-completed');
    let todoType = 'all';

    getTodo(todoType);
    function getTodo(todoType) {
        $.ajax({
            url: '/get-todo',
            type: 'POST',
            data: JSON.stringify({todoType}),
            success: function (response) {
                updateDom(response);
            }
        });
    }


    function updateDom(response) {
        let list = '';
        let listWrapper = $('.todo-list');
        if(response){
            $('.todo-count strong').text(response.length);
            $.each(response, function (e) {
                list += `<li class="${response[e].completed == 1 ? 'completed' : ''}"><div class="view"><input data-id="${response[e].id}"  class="toggle" type="checkbox" ${response[e].completed == 1 ? 'checked' : ''}><label>${response[e].task}</label><button data-id="${response[e].id}" class="destroy"></button></div><input data-id="${response[e].id}" class="edit" value="${response[e].task}"></li>`;
            });
            listWrapper.empty();
            listWrapper.append(list);
            list = '';
        }else{
            listWrapper.append(list);
        }
    }

    //Delete Todo
    $(document).on('click', '.destroy', function () {
        let id = $(this).data().id
        deleteTask(id);
        getTodo(todoType);
    });

    // Create Todo
    createTodo.on('keyup', function (e) {
        if (e.keyCode === 13) {
            let value = $('.new-todo').val();
            newTodo(value);
            createTodo.val('');
            getTodo(todoType);
        }
    });

    // Edit Todo
    $(document).on('dblclick', '.view', function () {
        $('.view').parent('li').removeClass('editing');
        $(this).parent('li').addClass('editing');
    });

    //Deselect on outside Click
    $(document).on('click', function(e){
        if ($(e.target).is("li.editing input") === false) {
            $("li.editing").removeClass("editing");
        }
    });

   // Submit Editing
    $(document).on('keyup', '.edit', function (e) {
        if (e.keyCode === 13) {
            let id = $('.edit').data().id;
            let task = $('.edit').val();
            editTask(id, task);
            getTodo(todoType);
            $('.view').parent('li').removeClass('editing');

        }
    });

    // Filter Todo
    $('.filters li a').on('click', function(e){
        e.preventDefault();
        e.stopPropagation()
        $('.filters li a').removeClass('selected');
        $(this).addClass('selected');
        todoType = $(this).data().value;
        getTodo(todoType);
    });


    // Mark Todo
    $(document).on('click', '.toggle', function(){
        let id = $(this).data().id
        todoDone(id);
        getTodo(todoType);
    });

    function deleteTask(id) {
        $.ajax({
            url: '/delete',
            type: 'post',
            data: {id},
            success: function (response) {

            }
        });
    }

    function editTask(id, task) {
        $.ajax({
            url: '/edit-todo',
            type: 'post',
            data: JSON.stringify({id, task}),
            success: function (response) {

            }
        });
    }

    function newTodo(task) {
        $.ajax({
            url: '/new-todo',
            type: 'post',
            data: JSON.stringify({task}),
            success: function (response) {
            }
        });
    }

    clearComplete.on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $.ajax({
            url: '/delete-complete',
            type: 'GET',
            success: function (e) {
            }
        });
        getTodo(todoType);
    });

    function todoDone(id){
        $.ajax({
            url: '/edit-todo',
            type: 'post',
            data: JSON.stringify({id}),
            success: function (response) {
            }
        });
    }

$(document).on('click', '.toggle-all', function(){
    $.ajax({
        url: '/mark-all',
        type: 'GET',
        success: function (response) {
            getTodo(todoType);
        }
    });
});


    $('body').on("keydown", function (e) {
        if (e.keyCode === 27) {
            $('.todo-list').children('li').removeClass('editing');
        }
    });

});