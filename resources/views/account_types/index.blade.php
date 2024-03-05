<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jstree Example</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.11/themes/default/style.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <div class="py-4 px-5 chart-of-accounts-container" dir="rtl">
        <div class="row bg-white chart-of-accounts-row">
            <div class="col-lg-4" style="border-left: 1px #bbb solid;">
                <div id="tree" class="py-4"></div>
            </div>
            <div class="col-lg-8 chart-of-accounts-col chart-of-accounts-col-9">
                <div id="chart-of-accounts-child-board" class="chart-of-accounts-col-9-body-container">
                    <div style="position: relative;">
                        <table
                            class="list-table table table-hover not-clickable chart-of-accounts-col-9-body-container-table">
                            <tbody id="account_container">

                            </tbody>
                        </table>
                    </div>
                    <div class="add-account btn btn-secondary font-weight-bold text-dark rounded-0">
                        <i class="fa-solid fa-circle-plus text-success mr-2"></i>
                        <span>أضف حساب</span>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.11/jstree.min.js"></script>
    <script>
        $(document).ready(function () {
            let jsonData = @json($account_types);
    
            $('#tree').jstree({
                'core': {
                    'rtl': true,
                    'data': jsonData.map(function (accountType) {
                        return {
                            id: accountType.id.toString(), // Ensure the ID is a string
                            parent: accountType.parent_account_type_id !== null ? accountType.parent_account_type_id.toString() : '#',
                            text: accountType.name,
                            data: accountType.sub_types, // Store sub_types as data
                            type: (accountType.account_type === 'main' && accountType.parent_account_type_id === null) ? 'root' :
                    (accountType.account_type === 'main' && accountType.parent_account_type_id !== null) ? 'child' : 'single'
            };
                    }),
        //             $('#tree').jstree({
        // 'core': {
        //     'rtl': true,
        //     'data': jsonData.map(function (accountType) {
        //         let node = {
        //             id: accountType.id.toString(),
        //             parent: accountType.parent_account_type_id !== null ? accountType.parent_account_type_id.toString() : '#',
        //             text: accountType.name,
        //             type: (accountType.account_type === 'main' && accountType.parent_account_type_id === null) ? 'root' :
        //                 (accountType.account_type === 'main' && accountType.parent_account_type_id !== null) ? 'child' : 'single'
        //         };

        //         // Check if sub_types exist and recursively add them
        //         if (accountType.sub_types && accountType.sub_types.length > 0) {
        //             node.children = accountType.sub_types.map(function (subType) {
        //                 return {
        //                     id: subType.id.toString(),
        //                     text: subType.name,
        //                     type:(accountType.account_type === 'main' && accountType.parent_account_type_id !== null) ? 'child' : 'single',
        //                     data: subType.data 
        //                 };
        //             });
        //         }

        //         return node;
        //     }),
                


                    'themes': {
                        'variant': 'large',
                        'stripes': false,
                        'icons': true,
                    }
                },
                types: {
                    "root": {
                        "icon": "fa-solid fa-folder"
                    },
                    "child": {
                        "icon": "fa-solid fa-folder"
                    },
                    "single": {
                        "icon": "fa-solid fa-file"
                    }
                },
                plugins: ["types"],
            }).on('select_node.jstree', function (e, data) {
                data.instance.toggle_node(data.node);
                $("#account_container").empty();
                if (data.node.data) {
                    data.node.data.forEach(e => {
                        $("#account_container").append(ACCOUNT_ROW_HTML(e, data.node.children));
                    });
                }
            }).on('load_node.jstree', function (e, data) {
                const children = getChildren(jsonData, data.instance.get_selected()[0]);
                $("#account_container").empty();
                const selectedNodeId = data.instance.get_selected()[0];
                const selectedNode = jsonData.find(item => item.id == selectedNodeId)
                $("#tree").jstree()._open_to(selectedNode.children[0].id)
                if (children) {
                    children.forEach(e => {
                        $("#account_container").append(ACCOUNT_ROW_HTML(e));
                    });
                }
            });
    
            function getChildren(data, nodeId) {
                const node = data.find(item => item.id == nodeId);
                if (node && node.sub_types && node.sub_types.length > 0) {
                    return node.sub_types;
                } else {
                    return [];
                }
            }
        });


        function ACCOUNT_ROW_HTML(data) {
            return `
                <tr class="chart-of-accounts-col-9-body-container-table-row pointer">
                                    <td class="border-0">
                                        <div class="chart-of-accounts-col-9-body-container-table-item">
                                            <div class="item-container">
                                                <i class="icon fas fa-folder ms-3"></i>
                                                <div class="details">
                                                    <p class="name">${data.name}</p>
                                                    <p class="id">#${data.id}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-0 text-right" width="50">
                                        <div class="d-flex justify-content-end text-start">
                                            <div class="credit-wrap text-right mx-4">
                                                <div class="credit-container">
                                                    <p class="type">${data.account_type}</p>
                                                </div>
                                            </div>
                                            <div class="text-muted mx-2">
                                                <i class="fa-regular fa-pen-to-square pointer"></i>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
            `;
        }

    </script>

</body>

</html>