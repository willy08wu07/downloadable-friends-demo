require('./bootstrap')

import {nextTick} from "vue";

const App = {
    data() {
        return {
            messages: [],
            author_name: '',
            input_message: '',
        }
    },
    created() {
        this.fetchMessages()
    },
    computed: {
        validation_error() {
            if (this.author_name.trim().length === 0) {
                return '請輸入暱稱'
            } else if (this.author_name.length > 20) {
                return '暱稱太長'
            } else if (this.input_message.trim().length === 0) {
                return '請輸入訊息'
            } else if (this.input_message.length > 100) {
                return '訊息太長'
            }
            return ''
        }
    },
    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data.data.reverse().map(e => this.convertToPresenter(e))
                this.forceScrollDown()
            })
            Echo.channel('public')
                .listen('ChatMessagePosted', (e) => {
                    this.scrollDownWhenNeededAfter(() => {
                        this.messages.push(this.convertToPresenter(e.chatMessage))
                    })
                })
        },
        postNewMessage() {
            let newMessage = {
                author_name: this.author_name.trim(),
                message: this.input_message.trim(),
            }
            this.input_message = ''
            axios.post('/messages', newMessage).then(response => {
                let data = this.convertToPresenter(response.data.data)
                data.is_my_message = true
                this.messages.push(data)
                // 既然是自己貼的訊息，強制捲動到最下面。
                this.forceScrollDown()
            })
        },
        convertToPresenter(chatMessage) {
            chatMessage.is_my_message = false
            chatMessage.created_at = new Date(chatMessage.created_at).toLocaleString()
            return chatMessage
        },
        scrollDownWhenNeededAfter(addMessagesAction) {
            let div = this.$refs.chatMessages
            // 若使用者正在瀏覽前面的訊息，不要隨意幫他捲動到最下面。門檻值 100 像素。
            let isScrollDownNeeded = div.scrollTop > div.scrollHeight - div.clientHeight - 100
            addMessagesAction()
            if (isScrollDownNeeded) {
                this.forceScrollDown()
            }
        },
        forceScrollDown() {
            nextTick(() => {
                let div = this.$refs.chatMessages
                div.scrollTop = div.scrollHeight - div.clientHeight
            })
        }
    }
}
document.addEventListener("DOMContentLoaded", () => {
    Vue.createApp(App).mount('#app')
})
