
const mv_Express = require('express');
const mv_MariaDb = require('mariadb');

const app = mv_Express();
const port = 3000;
const mariadb = require('mariadb');


// https://www.npmjs.com/package/mariadb
const pool = mariadb.createPool(
            // https://github.com/mariadb-corporation/mariadb-connector-nodejs/blob/master/documentation/connection-options.md
            {
                        host: '192.168.0.21',
                        user: 'root',
                        connectionLimit: 5 ,
                        password: 'tlsrn815' ,
                        port:3306,
                        database:'coluddb',
                        multipleStatements : true,
                    }
            );


app.use(mv_Express.static('public'));

app.get('/', (req, res) => {
    res.send('Hello World!')
})

app.get('/signup_api', (req, res) => {
    var m_userid = req.query.userid;
    var m_userPW = req.query.userPW;
    var m_useremail = req.query.useremail;

    pool.getConnection()
        .then(conn => {

            conn.query("SELECT 1 as val")
                .then(rows => { // rows: [ {val: 1}, meta: ... ]
                    console.log('signup_api id="%s" pw="%s" email="%s"',m_userid, m_userPW, m_useremail);

                    return  conn.query(`
                                    call up_Signup(@v_Success, @v_Message,?,?,?);
                                    Select @v_Success as f_Success
                                    ,@v_Message as f_Message
                                    ;
                                    `
                        ,[m_userid,m_userPW,m_useremail]);

                })
                .then(res => { // res: { affectedRows: 1, insertId: 1, warningStatus: 0 }
                    console.log('signup_api success %o',res);
                    // if (res.Success = 'N') {
                    //
                    // }
                    conn.release(); // release to pool
                })
                .catch(err => {
                    console.log('signup_api catch %p',err);
                    conn.release(); // release to pool
                })

        }).catch(err => {
        res.send(err);
    });
    res.send('siguup_api completed...');

})

app.listen(port, () => {

    console.log('starup');
});

