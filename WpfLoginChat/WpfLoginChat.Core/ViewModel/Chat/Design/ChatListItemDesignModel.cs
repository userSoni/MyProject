using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace WpfLoginChat.Core
{
    public class ChatListItemDesignModel : ChatListItemViewModel
    {
        //single instance of the class design model
        public static ChatListItemDesignModel Instance => new ChatListItemDesignModel();
        public ChatListItemDesignModel()
        {
            Initials = "SA";
            Name = "Soniya";
            Message = "This chat is awesome !...";
            ProfilePictureRGB = "3385ff";
        }
    }
}
