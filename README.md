# Database-Systems

## 介紹

> 這是資料庫系統的期末專題，我們做的是北科二手書販賣網站，在這個網站中有兩種身分，管理員與使用者，管理員可以控制能夠販賣哪些書籍，使用者可以在這個網站販賣及購買書籍。

---

## 如何執行？

1. 先確保已經擁有 XAMPP、Node.js、vs code
2. 將 db.sql 匯入資料庫
3. 開啟 XAMPP 的 Apache、MySQL
4. Backend 資料夾中有兩個資料夾，php 放的是後端程式，以 php 語言撰寫，img 內的是商品的圖片，須將這兩個資料夾放到 C:\\xampp\\htdocs
5. Fronted 資料夾內的是前端程式，以 vue 語言撰寫，js 負責連接前端與後端，打開後輸入以下指令來下載需要的 package：
   > > > #### `npm install -g @vue/cli`
   > > >
   > > > #### `npm install`
6. 執行前端程式請輸入：
   > > > #### `npm run serve`
7. 完成後請打開網址：
   > > > #### `http://localhost:8080/`
