import junit.framework.Test;
import junit.framework.TestSuite;

public class ADMIN {

  public static Test suite() {
    TestSuite suite = new TestSuite();
    suite.addTestSuite(UC10.class);
    suite.addTestSuite(UC11.class);
    suite.addTestSuite(UC12.class);
    suite.addTestSuite(UC13.class);
    suite.addTestSuite(UC14.class);
    suite.addTestSuite(UC15.class);
    suite.addTestSuite(UC10_1.class);
    suite.addTestSuite(UC12_1.class);
    suite.addTestSuite(UC13_2.class);
    suite.addTestSuite(UC14_2.class);
    return suite;
  }

  public static void main(String[] args) {
    junit.textui.TestRunner.run(suite());
  }
}
