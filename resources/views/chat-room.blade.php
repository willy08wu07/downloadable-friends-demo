<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8">
    <title>聊天室</title>
    <script src="/js/app.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/css/app.css" rel="stylesheet">
</head>
<body class="font-sans">
<div id="app" class="w-full h-screen flex-col grid grid-cols-1 lg:grid-cols-4 bg-gray-200 dark:bg-gray-800">
    <div ref="chatMessages" class="row-start-1 lg:col-start-2 lg:col-span-2 overflow-y-auto">
        <div v-for="message in messages">
            <div v-if="!message.is_my_message" v-bind:lang="message.lang" class="grid grid-cols-3 p-2">
                <div class="col-start-1 col-span-2 text-gray-700 dark:text-gray-300 ml-2">
                    @{{ message.author_name }}
                </div>
                <div dir="auto" class="col-start-1 col-span-2">
                    <div class="float-left inline-block bg-purple-400 dark:bg-purple-800 text-gray-900 dark:text-gray-100 shadow-md rounded-lg text-lg pt-1 pb-1 pl-2 pr-2">
                        @{{ message.message }}
                    </div>
                </div>
                <div class="col-start-1 col-span-2 text-gray-400 dark:text-gray-600 ml-2">
                    @{{ message.created_at }}
                </div>
            </div>
            <div v-if="message.is_my_message" v-bind:lang="message.lang" class="grid grid-cols-3 p-2">
                <div class="col-end-4 col-span-2 text-gray-700 dark:text-gray-300 ml-2 text-right">
                    @{{ message.author_name }}
                </div>
                <div dir="auto" class="col-end-4 col-span-2">
                    <div class="float-right inline-block bg-yellow-300 dark:bg-yellow-700 text-gray-900 dark:text-gray-100 shadow-md rounded-lg text-lg pt-1 pb-1 pl-2 pr-2">
                        @{{ message.message }}
                    </div>
                </div>
                <div class="col-end-4 col-span-2 text-gray-400 dark:text-gray-600 ml-2 text-right">
                    @{{ message.created_at }}
                </div>
            </div>
        </div>
    </div>
    <div id="input" class="flex row-start-2 lg:col-start-2 lg:col-span-2">
        <input type="text" placeholder="您的暱稱" v-model="author_name" class="w-20 bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex-none p-2">
        <input type="text" dir="auto" placeholder="想分享什麼心情或想法？" v-model="input_message" class="w-40 bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex-auto p-2">
        <button v-if="validation_error" class="bg-purple-400 dark:bg-purple-800 text-gray-900 dark:text-gray-100 flex-none p-2">@{{ validation_error }}</button>
        <button v-if="!validation_error" v-on:click="postNewMessage" class="bg-yellow-300 dark:bg-yellow-700 text-gray-900 dark:text-gray-100 flex-none p-2">送出訊息</button>
    </div>
</div>
</body>
</html>
