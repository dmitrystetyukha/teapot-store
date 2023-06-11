
async function addTeapot(event) {
    event.preventDefault();

    const formData = new FormData(event.target);

    const response = await fetch('/add-teapot', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
        .catch(error => console.error(error));

    if (response.success) {
        alert('Чайник успешно добавлен');
        window.location.href = '/';
    } else {
        alert('Ошибка при добавлении чайника');
    }
}

async function updateTeapot(event) {
    event.preventDefault();

    const formData = new FormData(event.target);

    const response = await fetch('/update-teapot', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
        .catch(error => console.error(error));

    if (response.success) {
        alert('Данные успешно обновлены');
        window.location.href = '/';
    } else {
        alert('Ошибка при обновлении данных');
    }
}

async function deleteTeapot(target) {
    const id = target.closest('tr').id;
    const response = await fetch('/delete-teapot', {
        method: 'DELETE',
        body: JSON.stringify({ id: id }),
        headers: {'Content-Type': 'application/json'}
    }).then(response => response.json())
        .catch(error => console.error(error));

    if (response.success) {
        alert('Чайник удален');
        window.location.href = '/';
    } else {
        alert('Ошибка при удалении чайника');
    }
}


async function showAddForm() {
    const container = document.createElement('div');
    container.classList.add('container');

    const heading = document.createElement('h3');
    heading.classList.add('my-5');
    const link = document.createElement('a');
    link.setAttribute('href', '/');
    link.textContent = 'На главную';
    heading.appendChild(link);
    container.appendChild(heading);

    const h1 = document.createElement('h1');
    h1.classList.add('my-5');
    h1.textContent = 'Заполните данные:';
    container.appendChild(h1);

    const form = document.createElement('form');
    form.id = 'add-teapot-form';
    form.method = 'POST';

    const brandGroup = document.createElement('div');
    brandGroup.classList.add('form-group');
    const brandLabel = document.createElement('label');
    brandLabel.setAttribute('for', 'brand');
    brandLabel.textContent = 'Бренд';
    const brandInput = document.createElement('input');
    brandInput.setAttribute('type', 'text');
    brandInput.classList.add('form-control');
    brandInput.setAttribute('id', 'brand');
    brandInput.setAttribute('name', 'brand');
    brandInput.setAttribute('required', '');
    brandGroup.appendChild(brandLabel);
    brandGroup.appendChild(brandInput);
    form.appendChild(brandGroup);

    const modelGroup = document.createElement('div');
    modelGroup.classList.add('form-group');
    const modelLabel = document.createElement('label');
    modelLabel.setAttribute('for', 'model_name');
    modelLabel.textContent = 'Модель';
    const modelInput = document.createElement('input');
    modelInput.setAttribute('type', 'text');
    modelInput.classList.add('form-control');
    modelInput.setAttribute('id', 'model_name');
    modelInput.setAttribute('name', 'model_name');
    modelInput.setAttribute('required', '');
    modelGroup.appendChild(modelLabel);
    modelGroup.appendChild(modelInput);
    form.appendChild(modelGroup);

    const descriptionGroup = document.createElement('div');
    descriptionGroup.classList.add('form-group');
    const descriptionLabel = document.createElement('label');
    descriptionLabel.setAttribute('for', 'description');
    descriptionLabel.textContent = 'Описание';
    const descriptionTextarea = document.createElement('textarea');
    descriptionTextarea.setAttribute('rows', '3');
    descriptionTextarea.classList.add('form-control');
    descriptionTextarea.setAttribute('id', 'description');
    descriptionTextarea.setAttribute('name', 'description');
    descriptionTextarea.setAttribute('required', '');
    descriptionGroup.appendChild(descriptionLabel);
    descriptionGroup.appendChild(descriptionTextarea);
    form.appendChild(descriptionGroup);

    const costGroup = document.createElement('div');
    costGroup.classList.add('form-group');
    const costLabel = document.createElement('label');
    costLabel.setAttribute('for', 'cost');
    costLabel.textContent = 'Цена';
    const costInput = document.createElement('input');
    costInput.setAttribute('type', 'number');
    costInput.classList.add('form-control');
    costInput.setAttribute('id', 'cost');
    costInput.setAttribute('name', 'cost');
    costInput.setAttribute('required', '');
    costGroup.appendChild(costLabel);
    costGroup.appendChild(costInput);
    form.appendChild(costGroup);

    const stockGroup = document.createElement('div');
    stockGroup.classList.add('form-group');
    const stockLabel = document.createElement('label');
    stockLabel.setAttribute('for', 'stock_balance');
    stockLabel.textContent = 'Остаток на складе';
    const stockInput = document.createElement('input');
    stockInput.setAttribute('type', 'number');
    stockInput.classList.add('form-control');
    stockInput.setAttribute('id', 'stock_balance');
    stockInput.setAttribute('name', 'stock_balance');
    stockInput.setAttribute('required', '');
    stockGroup.appendChild(stockLabel);
    stockGroup.appendChild(stockInput);
    form.appendChild(stockGroup);

    const submitButton = document.createElement('button');
    submitButton.setAttribute('type', 'submit');
    submitButton.classList.add('btn', 'btn-primary');
    submitButton.textContent = 'Добавить';
    form.appendChild(submitButton);

    container.appendChild(form);
    document.querySelector('#teapot-list-table').replaceWith(container);

    form.addEventListener('submit', addTeapot);
}

async function showUpdateForm(target) {
    const id = target.closest('tr').id;
    const container = document.createElement('div');
    container.classList.add('container');

    const heading = document.createElement('h3');
    heading.classList.add('my-5');
    const link = document.createElement('a');
    link.setAttribute('href', '/');
    link.textContent = 'На главную';
    heading.appendChild(link);
    container.appendChild(heading);

    const title = document.createElement('h1');
    title.classList.add('my-5');
    title.textContent = 'Заполните новые данные:';
    container.appendChild(title);

    const form = document.createElement('form');
    form.setAttribute('id', 'add-teapot-form');
    form.setAttribute('method', 'POST');

    const idField = document.createElement('div');
    const idInput = document.createElement('input');
    idInput.setAttribute('type', 'hidden');
    idInput.setAttribute('class', 'form-control');
    idInput.setAttribute('id', 'id');
    idInput.setAttribute('name', 'id');
    idInput.setAttribute('value', id);
    idInput.setAttribute('required', '');
    idField.appendChild(idInput);
    form.appendChild(idField);

    const brandField = document.createElement('div');
    const brandLabel = document.createElement('label');
    brandLabel.setAttribute('for', 'brand');
    brandLabel.textContent = 'Бренд';
    const brandInput = document.createElement('input');
    brandInput.setAttribute('type', 'text');
    brandInput.setAttribute('class', 'form-control');
    brandInput.setAttribute('id', 'brand');
    brandInput.setAttribute('name', 'brand');
    brandInput.setAttribute('required', '');
    brandField.appendChild(brandLabel);
    brandField.appendChild(brandInput);
    form.appendChild(brandField);

    const modelField = document.createElement('div');
    const modelLabel = document.createElement('label');
    modelLabel.setAttribute('for', 'model_name');
    modelLabel.textContent = 'Модель';
    const modelInput = document.createElement('input');
    modelInput.setAttribute('type', 'text');
    modelInput.setAttribute('class', 'form-control');
    modelInput.setAttribute('id', 'model_name');
    modelInput.setAttribute('name', 'model_name');
    modelInput.setAttribute('required', '');
    modelField.appendChild(modelLabel);
    modelField.appendChild(modelInput);
    form.appendChild(modelField);

    const descField = document.createElement('div');
    const descLabel = document.createElement('label');
    descLabel.setAttribute('for', 'description');
    descLabel.textContent = 'Описание';
    const descTextarea = document.createElement('textarea');
    descTextarea.setAttribute('rows', '3');
    descTextarea.setAttribute('class', 'form-control');
    descTextarea.setAttribute('id', 'description');
    descTextarea.setAttribute('name', 'description');
    descTextarea.setAttribute('required', '');
    descField.appendChild(descLabel);
    descField.appendChild(descTextarea);
    form.appendChild(descField);

    const costField = document.createElement('div');
    const costLabel = document.createElement('label');
    costLabel.setAttribute('for', 'cost');
    costLabel.textContent = 'Цена';
    const costInput = document.createElement('input');
    costInput.setAttribute('type', 'number');
    costInput.setAttribute('class', 'form-control');
    costInput.setAttribute('id', 'cost');
    costInput.setAttribute('name', 'cost');
    costInput.setAttribute('required', '');
    costField.appendChild(costLabel);
    costField.appendChild(costInput);
    form.appendChild(costField);

    const stockField = document.createElement('div');
    const stockLabel = document.createElement('label');
    stockLabel.setAttribute('for', 'stock_balance');
    stockLabel.textContent = 'Остаток на складе';
    const stockInput = document.createElement('input');
    stockInput.setAttribute('type', 'number');
    stockInput.setAttribute('class', 'form-control');
    stockInput.setAttribute('id', 'stock_balance');
    stockInput.setAttribute('name', 'stock_balance');
    stockInput.setAttribute('required', '');
    stockField.appendChild(stockLabel);
    stockField.appendChild(stockInput);
    form.appendChild(stockField);

    const submitButton = document.createElement('button');
    submitButton.setAttribute('type', 'submit');
    submitButton.classList.add('btn', 'btn-primary');
    submitButton.textContent = 'Добавить';
    form.appendChild(submitButton);

    addEventListener('submit', updateTeapot);

    container.appendChild(form);

    document.querySelector('#teapot-list-table').replaceWith(container);
}

async function showTable() {
    const response = await fetch('/teapot-list')
        .then(response => response.json())
        .catch(error => console.error(error));

    const {data: teapots} = response;

    const tbody = document.querySelector('#teapots-table tbody');

    teapots.forEach(teapot => {
        const tr = document.createElement('tr');

        tr.id = teapot.id;

        tr.innerHTML = `
            <td>${teapot.fullname}</td>
            <td>${teapot.description}</td>
            <td>${teapot.cost}</td>
            <td>${teapot.stock_balance}</td>
        `;

        const tdActions = document.createElement('td');
        const btnDelete = document.createElement('button');
        btnDelete.classList.add('mx-1', 'btn', 'btn-outline-danger');
        btnDelete.textContent = 'Удалить';
        btnDelete.addEventListener('click', async () => deleteTeapot(btnDelete));
        tdActions.appendChild(btnDelete);

        const btnEdit = document.createElement('button');
        btnEdit.textContent = 'Редактировать';
        btnEdit.classList.add('mx-1', 'btn', 'btn-outline-primary');
        btnEdit.addEventListener('click', () => showUpdateForm(btnEdit));
        tdActions.appendChild(btnEdit);

        tr.appendChild(tdActions);

        tbody.appendChild(tr);
    });
}

(async function() {
    await showTable();

    document.querySelector('#add-teapot-button').addEventListener('click', showAddForm);
})();