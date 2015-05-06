import junit.framework.Test;
import junit.framework.TestSuite;

public class WA {

  public static Test suite() {
    TestSuite suite = new TestSuite();
    suite.addTestSuite(WA-Suite.class);
    suite.addTestSuite(UC1.class);
    suite.addTestSuite(UC3+4.class);
    suite.addTestSuite(UC5.class);
    suite.addTestSuite(UC6.class);
    suite.addTestSuite(UC6_1.class);
    suite.addTestSuite(UC7.class);
    suite.addTestSuite(UC9.class);
    return suite;
  }

  public static void main(String[] args) {
    junit.textui.TestRunner.run(suite());
  }
}
