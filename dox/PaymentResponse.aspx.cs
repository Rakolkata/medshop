using System;
using System.Collections;
using System.Configuration;
using System.Data;
//using System.Linq;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.HtmlControls;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
//using System.Xml.Linq;
using CCA.Util;
using System.Collections.Specialized;
using System.Data.SqlClient;
using System.Drawing;

public partial class PaymentResponse : System.Web.UI.Page
{
    string constring = ConfigurationManager.ConnectionStrings["DatabaseConnection"].ToString();
    SqlConnection con;
    SqlCommand cmd;
    SqlDataAdapter da;
    protected void Page_Load(object sender, EventArgs e)
    {
        try
        {
            string update = "";
            string order_id = "";
            string workingKey = "0F0F22D8E42E5DF52C35FD178D12B093";//put in the 32bit alpha numeric key in the quotes provided here
            CCACrypto ccaCrypto = new CCACrypto();
            string encResponse = ccaCrypto.Decrypt(Request.Form["encResp"], workingKey);
            NameValueCollection Params = new NameValueCollection();
            string[] segments = encResponse.Split('&');
            foreach (string seg in segments)
            {
                string[] parts = seg.Split('=');
                if (parts.Length > 0)
                {
                    string Key = parts[0].Trim();
                    string Value = parts[1].Trim();
                    Params.Add(Key, Value);
                }
            }

            for (int i = 0; i < Params.Count; i++)
            {
                //Response.Write(Params.Keys[i] + " = " + Params[i] + "<br>");
                switch (Params.Keys[i])
                {
                    case "order_id": order_id = Params[i];
                        break;
                    case "tracking_id": update += "TRACKING_ID='" + Params[i] + "',";
                        break;
                    case "bank_ref_no": update += "BANK_REF_NO='" + Params[i] + "',";
                        Label2.Text = Params[i];
                        break;
                    case "order_status": update += "STATUS='" + Params[i] + "',";
                        Label5.Text = Params[i];
                        break;
                    case "payment_mode": update += "PAYMENT_MODE='" + Params[i] + "',";
                        Label1.Text = Params[i];
                        break;
                    case "trans_date": if (Params[i] != "null")
                        {
                            update += "TRANS_DATE='" + Params[i] + "',";
                        }
                        Label3.Text = Params[i];
                        break;
                    case "amount": Label4.Text = Params[i];
                        break;
                }
            }
            if (update != "")
            {
                update = update.Substring(0, update.Length - 1);
                string query = "UPDATE PAYMENT_TRANS SET " + update + " WHERE ID='" + order_id + "'";
                //Response.Write(query);
                con = new SqlConnection(constring);
                if (con.State == ConnectionState.Closed)
                {
                    con.Open();
                }
                cmd = new SqlCommand(query, con);
                cmd.CommandTimeout = 72000;
                cmd.ExecuteNonQuery();
                con.Close();
            }
            else
            {
                Response.Redirect("Payment.aspx");
            }
        }
        catch (SystemException ex)
        {
            Response.Write(ex.Message);
            //Response.Redirect("Payment.aspx");
        }
    }

    protected void btnSubmit_Click(object sender, EventArgs e)
    {
        Response.Redirect("Payment.aspx", false);
    }
}
