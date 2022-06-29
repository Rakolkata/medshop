using System;
using System.Collections;
using System.Configuration;
using System.Data;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.HtmlControls;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using CCA.Util;
using System.Collections.Specialized;
using System.Data.SqlClient;
using System.Drawing;

public partial class Payment : System.Web.UI.Page
{
    string constring = ConfigurationManager.ConnectionStrings["DatabaseConnection"].ToString();
    SqlConnection con;
    SqlCommand cmd;
    SqlDataAdapter da;
    CCACrypto ccaCrypto = new CCACrypto();
    string workingKey = "";//put in the 32bit alpha numeric key in the quotes provided here 	
    string ccaRequest = "";
    public string strEncRequest = "";
    public string strAccessCode = "";// put the access key in the quotes provided here.
    protected void Page_Load(object sender, EventArgs e)
    {

    }

    public void btnSubmit_Click(object sender, EventArgs e)
    {
        Label1.ForeColor = Color.Green;
        try
        {
            con = new SqlConnection(constring);
            if (con.State == ConnectionState.Closed)
            {
                con.Open();
            }
            cmd = new SqlCommand("INSERT INTO PAYMENT_TRANS(CUST_ID,INVOICE,AMOUNT,NAME,EMAIL,PHONE,MESSAGE,TRANS_START_DATE,TRANS_START_TIME)VALUES('"
                + txtcustid.Text + "','"
                + txtinvoice.Text + "','"
                + txtamount.Text + "','"
                + txtname.Text + "','" 
                + txtemail.Text + "','" 
                + txtphone.Text + "','"
                + txtmessage.Value.ToString() + "',CONVERT(VARCHAR(10),GETDATE(),120),CONVERT(VARCHAR(10),GETDATE(),108))", con);
            cmd.CommandTimeout = 72000;
            cmd.ExecuteNonQuery();
            da = new SqlDataAdapter("SELECT MAX(ID) AS ID FROM PAYMENT_TRANS WHERE CUST_ID='"
                + txtcustid.Text + "' AND INVOICE='"
                + txtinvoice.Text + "' AND AMOUNT='"
                + txtamount.Text + "' AND NAME='"
                + txtname.Text + "' AND EMAIL='" + txtemail.Text + "' AND PHONE='" + txtphone.Text + "'", con);
            da.SelectCommand.CommandTimeout = 72000;
            DataTable dt = new DataTable();
            da.Fill(dt);
            string order_id = dt.Rows[0]["ID"].ToString();
            con.Close();
            DataTable dt1 = new DataTable();
            dt1 = credentials().Copy();
            string merchant_id = dt1.Rows[0]["MERCHENT_ID"].ToString();
            workingKey = dt1.Rows[0]["WORKING_KEY"].ToString();
            strAccessCode = dt1.Rows[0]["ACCESS_CODE"].ToString();
            string url = dt1.Rows[0]["URL"].ToString();
            string amount = txtamount.Text;
            string redirect = "http://crm.vprotectindia.com/PaymentResponse.aspx";
            string cancel_url = "http://crm.vprotectindia.com/PaymentResponse.aspx";
            ccaRequest = "tid=&merchant_id=" + merchant_id + "&order_id=" + order_id + "&amount=" + amount + "&currency=INR&redirect_url=" + redirect + "&cancel_url=" + cancel_url + "&billing_name=&billing_address=&billing_city=New Delhi&billing_state=Delhi&billing_zip=110045&billing_country=&billing_tel=" + txtphone.Text + "&billing_email=" + txtemail.Text + "&delivery_name=" + txtname.Text + "&delivery_address=" + txtphone.Text + "&delivery_city=New Delhi&delivery_state=Delhi&delivery_zip=110045&delivery_country=India&delivery_tel=" + txtphone.Text + "&merchant_param1=&merchant_param2=&merchant_param3=&merchant_param4=&merchant_param5=&promo_code=&customer_identifier=&";
            strEncRequest = ccaCrypto.Encrypt(ccaRequest, workingKey);
            Response.Redirect(url + "&encRequest=" + strEncRequest + "&access_code=" + strAccessCode, false);
        }
        catch (SystemException ex)
        {
            Label1.Text = ex.Message;
            Label1.ForeColor = Color.Red;
        }
    }

    private DataTable credentials()
    {
        DataTable dt = new DataTable();
        con = new SqlConnection(constring);
        if (con.State == ConnectionState.Closed)
        {
            con.Open();
        }
        da = new SqlDataAdapter("SELECT * FROM PAYMENT_GATEWAY_CREDENTIALS WHERE STATUS='1'", con);
        da.SelectCommand.CommandTimeout = 72000;
        da.Fill(dt);
        return dt;
    }
}
