import jpcap.*;
import jpcap.packet.*;

public class test {
   public static void main(String[] args)
   {
      JpcapCaptor captor=null;
      try{
        captor=JpcapCaptor.openFile(args[0]);
      } catch (Exception e) {
        // we should do something with the exception.
	System.out.println("Error opening file " + args[0]);
        return;
      }

      while(true){
         //read a packet from the opened file
         Packet packet=captor.getPacket();
         //if some error occurred or EOF has reached, break the loop
         if(packet==null || packet==Packet.EOF) break;
         //otherwise, print out the packet
         System.out.println(packet);
      }

      captor.close();
   }
}